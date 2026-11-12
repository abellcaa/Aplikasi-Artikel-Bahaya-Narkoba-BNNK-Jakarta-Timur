<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BnnApplicationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_welcome_page_renders_successfully(): void
    {
        $response = $this->get('/welcome');
        $response->assertStatus(200);
        $response->assertSee('BNN Kota Jakarta Timur');
    }

    public function test_home_page_renders_with_articles_and_categories(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Hotline P4GN');
        $response->assertSee('Kelompok Artikel');
    }

    public function test_articles_index_renders_with_filter(): void
    {
        $response = $this->get('/artikel?category=narkotika-golongan-1');
        $response->assertStatus(200);
        $response->assertSee('Narkotika Golongan I');
    }

    public function test_article_detail_page_renders_and_increments_views(): void
    {
        $article = Article::where('is_published', true)->first();
        $initialViews = $article->views_count;

        $response = $this->get('/artikel/' . $article->slug);
        $response->assertStatus(200);
        $response->assertSee($article->title);

        $this->assertEquals($initialViews + 1, $article->fresh()->views_count);
    }

    public function test_guest_cannot_bookmark_or_download_articles(): void
    {
        $article = Article::where('is_published', true)->firstOrFail();

        $this->get('/artikel/' . $article->slug)
            ->assertOk()
            ->assertDontSee(route('bookmarks.toggle', $article->id), false)
            ->assertDontSee('Unduh PDF');

        $this->post('/artikel/' . $article->id . '/simpan')
            ->assertRedirect(route('login'));

        $this->get(route('articles.download', $article->slug))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_download_article_as_pdf(): void
    {
        $user = User::where('role', 'user')->firstOrFail();
        $article = Article::where('is_published', true)->firstOrFail();

        $response = $this->actingAs($user)->get(route('articles.download', $article->slug));

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');
        $this->assertStringStartsWith('%PDF-', $response->getContent());
    }

    public function test_search_page_works_with_keywords(): void
    {
        $response = $this->get('/pencarian?q=sabu');
        $response->assertStatus(200);
        $response->assertSee('Hasil Pencarian');
    }

    public function test_about_and_contact_pages_render_properly(): void
    {
        $responseAbout = $this->get('/tentang');
        $responseAbout->assertStatus(200);
        $responseAbout->assertSee('Visi BNN');

        $responseContact = $this->get('/kontak');
        $responseContact->assertStatus(200);
        $responseContact->assertSee('184');
    }

    public function test_user_can_submit_feedback_and_it_stores_in_db(): void
    {
        $response = $this->post('/kritik-saran', [
            'name' => 'Ahmad Fauzi',
            'email' => 'fauzi@example.com',
            'category' => 'permohonan_rehabilitasi',
            'message' => 'Apakah klinik BNN Kota Jakarta Timur melayani konseling di hari libur?',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('feedbacks', [
            'email' => 'fauzi@example.com',
            'subject' => 'Permohonan Rehabilitasi',
            'category' => 'permohonan_rehabilitasi',
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_filter_and_print_feedback_by_category_and_date(): void
    {
        $admin = User::where('role', 'admin')->first();
        Feedback::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'subject' => 'Saran Fitur',
            'category' => 'saran_fitur',
            'message' => 'Mohon tambahkan pencarian artikel yang lebih mudah.',
            'status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->get('/admin/feedbacks?category=saran_fitur&date_from=2000-01-01&date_to=2099-12-31')
            ->assertOk()
            ->assertSee('Siti Aminah');

        $this->actingAs($admin)
            ->get('/admin/feedbacks/print?category=saran_fitur&date_from=2000-01-01&date_to=2099-12-31')
            ->assertOk()
            ->assertSee('Laporan Kritik & Saran', false)
            ->assertSee('Siti Aminah');
    }

    public function test_user_profile_shows_feedback_history_and_admin_reply(): void
    {
        $user = User::where('role', 'user')->first();
        Feedback::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'Permohonan Penyuluhan',
            'category' => 'permohonan_penyuluhan',
            'message' => 'Mohon jadwalkan penyuluhan untuk sekolah kami.',
            'status' => 'replied',
            'admin_reply' => 'Silakan hubungi petugas melalui kontak resmi.',
        ]);

        $this->actingAs($user)
            ->get('/profil')
            ->assertOk()
            ->assertSee($user->name)
            ->assertSee('Mohon jadwalkan penyuluhan untuk sekolah kami.')
            ->assertSee('Silakan hubungi petugas melalui kontak resmi.');
    }

    public function test_user_can_bookmark_and_unbookmark_article(): void
    {
        $user = User::where('role', 'user')->first();
        // Clear existing bookmarks for clean test
        \App\Models\Bookmark::where('user_id', $user->id)->delete();

        $article = Article::first();

        // Bookmark
        $response = $this->actingAs($user)->post('/artikel/' . $article->id . '/simpan');
        $response->assertRedirect();
        $this->assertDatabaseHas('bookmarks', [
            'user_id' => $user->id,
            'article_id' => $article->id,
        ]);

        // Access saved articles page
        $savedResponse = $this->actingAs($user)->get('/tersimpan');
        $savedResponse->assertStatus(200);
        $savedResponse->assertSee($article->title);

        // Unbookmark
        $this->actingAs($user)->post('/artikel/' . $article->id . '/simpan');
        $this->assertDatabaseMissing('bookmarks', [
            'user_id' => $user->id,
            'article_id' => $article->id,
        ]);
    }

    public function test_admin_can_access_dashboard_and_normal_user_is_forbidden(): void
    {
        $admin = User::where('role', 'admin')->first();
        $user = User::where('role', 'user')->first();

        // Normal user should be redirected
        $userResponse = $this->actingAs($user)->get('/admin');
        $userResponse->assertRedirect(route('home'));

        // Admin can access
        $adminResponse = $this->actingAs($admin)->get('/admin');
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Dashboard Utama');
    }

    public function test_admin_can_reply_feedback_via_email(): void
    {
        Mail::fake();

        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::where('status', 'pending')->first();

        $response = $this->actingAs($admin)->post('/admin/feedbacks/' . $feedback->id . '/reply', [
            'reply_message' => 'Terima kasih atas masukannya. Tim BNN Kota Jakarta Timur akan menindaklanjuti hal tersebut.',
        ]);

        $response->assertRedirect(route('admin.feedbacks.show', $feedback->id));

        $feedback->refresh();
        $this->assertEquals('replied', $feedback->status);
        $this->assertEquals('Terima kasih atas masukannya. Tim BNN Kota Jakarta Timur akan menindaklanjuti hal tersebut.', $feedback->admin_reply);
        $this->assertEquals($admin->id, $feedback->replied_by);

        Mail::assertSent(\App\Mail\FeedbackReplyMail::class, function ($mail) use ($feedback) {
            return $mail->hasTo($feedback->email);
        });
    }

    public function test_admin_can_create_edit_and_delete_articles(): void
    {
        $admin = User::where('role', 'admin')->first();
        $category = Category::first();

        // Create Article
        $createResponse = $this->actingAs($admin)->post('/admin/articles', [
            'category_id' => $category->id,
            'title' => 'Uji Coba Artikel Bahaya Lem Aibon Bagi Paru-Paru',
            'summary' => 'Inhalan seperti lem sintetis memicu kerusakan otak mendadak dan asfiksia.',
            'content' => 'Praktik menghirup zat perekat atau ngelem sangat berbahaya bagi sistem pernapasan dan syaraf pusat anak-anak.',
            'reading_time' => 3,
            'is_published' => '1',
        ]);

        $createResponse->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseHas('articles', [
            'title' => 'Uji Coba Artikel Bahaya Lem Aibon Bagi Paru-Paru',
        ]);

        $createdArticle = Article::where('title', 'Uji Coba Artikel Bahaya Lem Aibon Bagi Paru-Paru')->first();

        // Update Article
        $updateResponse = $this->actingAs($admin)->put('/admin/articles/' . $createdArticle->id, [
            'category_id' => $category->id,
            'title' => 'Uji Coba Artikel Bahaya Lem Aibon - Diperbarui',
            'summary' => 'Inhalan seperti lem sintetis memicu kerusakan otak mendadak dan asfiksia.',
            'content' => 'Praktik menghirup zat perekat sangat berbahaya bagi kesehatan.',
            'reading_time' => 4,
            'is_published' => '1',
        ]);

        $updateResponse->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseHas('articles', [
            'title' => 'Uji Coba Artikel Bahaya Lem Aibon - Diperbarui',
        ]);

        // Delete Article
        $deleteResponse = $this->actingAs($admin)->delete('/admin/articles/' . $createdArticle->id);
        $deleteResponse->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseMissing('articles', [
            'id' => $createdArticle->id,
        ]);
    }
}
