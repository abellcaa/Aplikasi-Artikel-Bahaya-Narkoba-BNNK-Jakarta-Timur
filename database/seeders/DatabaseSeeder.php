<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin & Users
        $admin = User::create([
            'name' => 'Administrator BNN Jaktim',
            'email' => 'admin@bnn-jaktim.go.id',
            'role' => 'admin',
            'phone' => '081288990011',
            'password' => Hash::make('password'),
        ]);

        $user1 = User::create([
            'name' => 'Bella Nurfadilah',
            'email' => 'bella@gmail.com',
            'role' => 'user',
            'phone' => '085712345678',
            'password' => Hash::make('password'),
        ]);

        $user2 = User::create([
            'name' => 'Rizky Pratama',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'phone' => '081399887766',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Categories (Kelompok Artikel)
        $categoriesData = [
            [
                'name' => 'Narkotika Golongan I',
                'slug' => 'narkotika-golongan-1',
                'description' => 'Golongan narkotika paling berbahaya dengan potensi adiksi sangat tinggi, dilarang untuk pelayanan kesehatan.',
                'icon' => 'skull',
            ],
            [
                'name' => 'Psikotropika & Obat Keras',
                'slug' => 'psikotropika-obat-keras',
                'description' => 'Zat psikoaktif yang mempengaruhi susunan saraf pusat, menyebabkan perubahan mental dan perilaku jika disalahgunakan.',
                'icon' => 'pill',
            ],
            [
                'name' => 'Dampak Fisik & Psikis',
                'slug' => 'dampak-fisik-psikis',
                'description' => 'Kerusakan organ vital otak, jantung, ginjal serta gangguan kejiwaan akibat racun zat narkotika.',
                'icon' => 'activity',
            ],
            [
                'name' => 'Pencegahan Generasi Muda',
                'slug' => 'pencegahan-generasi-muda',
                'description' => 'Edukasi ketahanan diri bagi remaja, peran orang tua, dan kiat tegas menolak bujukan jeratan narkoba.',
                'icon' => 'shield-check',
            ],
            [
                'name' => 'Layanan Rehabilitasi BNN',
                'slug' => 'layanan-rehabilitasi-bnn',
                'description' => 'Alur dan hak pemulihan medis & sosial pecandu narkoba secara gratis dan tanpa pidana di BNN Jakarta Timur.',
                'icon' => 'heart-handshake',
            ],
            [
                'name' => 'Hukum & Regulasi P4GN',
                'slug' => 'hukum-regulasi-p4gn',
                'description' => 'Ketentuan Undang-Undang No. 35 Tahun 2009 serta payung hukum bagi pelapor sukarela narkoba.',
                'icon' => 'scale',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cData) {
            $categories[$cData['slug']] = Category::create($cData);
        }

        // 3. Create Articles
        $articlesData = [
            [
                'category_id' => $categories['narkotika-golongan-1']->id,
                'user_id' => $admin->id,
                'title' => 'Mengenal Bahaya Sabu (Metamfetamin) dan Kerusakan Otak Permanen',
                'slug' => 'mengenal-bahaya-sabu-metamfetamin-kerusakan-otak',
                'summary' => 'Sabu atau metamfetamin adalah stimulan kuat yang memicu lonjakan dopamin ekstrem dan menyebabkan kerusakan saraf otak permanen dalam jangka panjang.',
                'content' => "Metamfetamin, atau yang lebih dikenal luas sebagai sabu-sabu, merupakan salah satu jenis Narkotika Golongan I yang paling sering disalahgunakan di Indonesia. Zat ini berbentuk kristal putih mengkilap dan tidak berbau.\n\n### Cara Kerja Sabu pada Tubuh\nSabu bekerja dengan merangsang pelepasan neurotransmiter dopamin dalam jumlah yang sangat besar di otak—bisa mencapai 1.000 kali lipat dari batas normal. Hal ini memicu rasa percaya diri palsu, euforia sesaat, dan hilangnya rasa kantuk serta lapar.\n\n### Dampak Buruk Sabu-sabu:\n1. **Kerusakan Pembuluh Darah Otak**: Risiko stroke dan pendarahan otak meningkat tajam bahkan pada pemakaian pertama.\n2. **Halusinasi dan Delusi Akut**: Pengguna sering merasa dikejar-kejar, curiga berlebihan (paranoid), hingga mendengar suara gaib.\n3. **Meth Mouth**: Kerusakan gigi parah dan pembusukan gusi akibat penurunan produksi saliva dan kebiasaan menggemeretakkan gigi.\n4. **Ketergantungan Kuat**: Tubuh berhenti memproduksi dopamin alami sehingga pecandu akan mengalami depresi berat saat efek obat habis.\n\nBNN Kota Jakarta Timur mengimbau seluruh masyarakat untuk tidak sekali-kali mencoba zat ini karena sifat adiksinya yang menjerat sejak pemakaian awal.",
                'reading_time' => 4,
                'views_count' => 342,
                'is_published' => true,
            ],
            [
                'category_id' => $categories['dampak-fisik-psikis']->id,
                'user_id' => $admin->id,
                'title' => '5 Gejala Fisik dan Perubahan Sikap Remaja yang Terjerat Narkoba',
                'slug' => '5-gejala-fisik-perubahan-sikap-remaja-terjerat-narkoba',
                'summary' => 'Ketahui tanda-tanda awal perubahan fisik dan perilaku pada anak atau remaja untuk deteksi dini sebelum kecanduan semakin parah.',
                'content' => "Deteksi dini merupakan kunci penyelamatan seseorang dari jurang narkoba. Seringkali orang tua dan guru baru menyadari ketika korban sudah mengalami ketergantungan berat.\n\n### 1. Perubahan Pola Tidur dan Mata\nMata sering terlihat merah, pupil membesar atau mengecil secara drastis, serta kantung mata yang menghitam karena pola tidur terbalik (terjaga di malam hari dan tidur di siang hari).\n\n### 2. Penurunan Prestasi dan Bolos Sekolah\nMinat terhadap pelajaran, hobi, dan aktivitas ekstrakurikuler merosot drastis. Sering membolos atau datang terlambat tanpa alasan yang jelas.\n\n### 3. Bersikap Tertutup dan Emosional\nCenderung mengurung diri di dalam kamar, mengunci pintu, mudah tersinggung, agresif, dan bereaksi berlebihan saat ditanya tentang aktivitasnya.\n\n### 4. Kehilangan Barang Berharga di Rumah\nKebutuhan membeli zat narkotika menuntut biaya yang terus meningkat. Gejala umum meliputi hilangnya uang tunai, barang elektronik, atau perhiasan di lingkungan rumah.\n\n### 5. Kebersihan Diri yang Menurun\nPengguna narkoba sering mengabaikan kebersihan diri, bau badan tidak sedap, pakaian lusuh, dan penurunan berat badan secara drastis dalam waktu singkat.",
                'reading_time' => 3,
                'views_count' => 520,
                'is_published' => true,
            ],
            [
                'category_id' => $categories['layanan-rehabilitasi-bnn']->id,
                'user_id' => $admin->id,
                'title' => 'Alur Pelayanan Rehabilitasi Gratis di BNN Kota Jakarta Timur',
                'slug' => 'alur-pelayanan-rehabilitasi-gratis-bnn-jakarta-timur',
                'summary' => 'Pecandu narkoba adalah korban yang berhak pulih. Pelajari langkah pelaporan diri dan asesmen terpadu gratis tanpa rasa takut dipenjara.',
                'content' => "Badan Narkotika Nasional (BNN) menegaskan bahwa penyalahguna narkoba dipandang sebagai korban yang wajib mendapatkan perawatan medis dan sosial melalui program Rehabilitasi.\n\n### Prosedur Pelayanan Rehabilitasi:\n1. **Kedatangan & Pendaftaran Sukarela**: Keluarga atau penyalahguna datang langsung ke Klinik Pratama BNN Kota Jakarta Timur.\n2. **Asesmen Medis & Psikososial**: Tim dokter dan konselor adiksi melakukan pemeriksaan riwayat zat, kondisi fisik, dan tingkat keparahan adiksi.\n3. **Rencana Terapi**: Penentuan apakah pasien membutuhkan Rawat Jalan (Outpatient) atau rujukan Rawat Inap (Inpatient) di Balai Besar Rehabilitasi Lido BNN.\n4. **Konseling & Pascarehabilitasi**: Pendampingan berkala agar mantan penyalahguna siap kembali berdaya di tengah keluarga dan masyarakat.\n\n### Jaminan Kerahasiaan dan Bebas Pidana:\nBerdasarkan Pasal 54 & 55 UU No. 35 Tahun 2009, pecandu yang secara sukarela melaporkan diri ke Institusi Penerima Wajib Lapor (IPWL) **TIDAK AKAN DIHUKUM ATAU DIPIDANA**.",
                'reading_time' => 5,
                'views_count' => 610,
                'is_published' => true,
            ],
            [
                'category_id' => $categories['psikotropika-obat-keras']->id,
                'user_id' => $admin->id,
                'title' => 'Waspada Peredaran Pil Hexymer dan Tramadol Ilegal di Kalangan Pelajar',
                'slug' => 'waspada-peredaran-pil-hexymer-tramadol-ilegal-pelajar',
                'summary' => 'Penyalahgunaan obat daftar G seperti Hexymer dan Tramadol tanpa resep dokter menimbulkan halusinasi berbahaya dan kerusakan saraf motorik.',
                'content' => "Obat-obatan keras golongan Daftar G seperti Tramadol, Hexymer, dan Trihexyphenidyl kini kerap disalahgunakan oleh sebagian oknum remaja karena harganya yang murah dan mudah diperoleh secara ilegal.\n\n### Bahaya Mengonsumsi Obat Keras Tanpa Resep:\n- **Kerusakan Jantung & Ginjal**: Overdosis obat jenis ini dapat menyebabkan henti nafas mendadak dan gagal ginjal akut.\n- **Pemicu Perilaku Agresif & Tawuran**: Efek mati rasa dan hilangnya kontrol diri akibat obat keras sering menjadi pemicu utama aksi kekerasan jalanan dan tawuran pelajar.\n- **Koma hingga Kematian**: Konsumsi dalam jumlah melebihi dosis terapeutik dapat menyebabkan kejang parah (seizure) dan koma.\n\nBNN Kota Jakarta Timur bersama aparat penegak hukum terus melakukan razia apotek ilegal dan toko obat tanpa izin untuk memutus rantai pasokan obat berbahaya ini.",
                'reading_time' => 3,
                'views_count' => 412,
                'is_published' => true,
            ],
            [
                'category_id' => $categories['pencegahan-generasi-muda']->id,
                'user_id' => $admin->id,
                'title' => 'Strategi Ketahanan Diri: 4 Cara Tegas Menolak Ajakan Narkoba dari Teman Sebaya',
                'slug' => 'strategi-ketahanan-diri-4-cara-tegas-menolak-ajakan-narkoba',
                'summary' => 'Tekanan teman sebaya (peer pressure) adalah pintu masuk utama penyalahgunaan zat. Berikut kiat psikologis menolak tanpa ragu.',
                'content' => "Seringkali rasa 'tidak enakan' atau takut dikucilkan dari pergaulan membuat seorang remaja terpaksa menerima tawaran rokok, miras, hingga narkoba. Membangun ketahanan diri (self-resilience) adalah benteng terkuat.\n\n### 1. Katakan 'TIDAK' dengan Bahasa Tubuh Percaya Diri\nUcapkan penolakan secara jelas dan tegas: *'Maaf, saya tidak mau dan tidak tertarik sama sekali.'* Tatap mata lawan bicara dan jangan ragu-ragu.\n\n### 2. Berikan Alasan Singkat yang Kuat\n*'Saya atlet sekolah, ini bisa merusak karir dan fisik saya'*, atau *'Keluarga saya sangat melarang dan saya menghormati mereka.'*\n\n### 3. Alihkan Percakapan ke Aktivitas Positif\nAjak teman untuk melakukan kegiatan lain seperti berolahraga bersama, bermain game, atau berkumpul di tempat terbuka.\n\n### 4. Tinggalkan Lingkungan yang Toxic\nJika mereka terus memaksa dan tidak menghargai batasanmu, itu tandanya mereka bukan teman yang baik. Segera tinggalkan tempat tersebut dan ceritakan kepada orang tua atau guru BK.",
                'reading_time' => 4,
                'views_count' => 488,
                'is_published' => true,
            ],
            [
                'category_id' => $categories['hukum-regulasi-p4gn']->id,
                'user_id' => $admin->id,
                'title' => 'Memahami UU No. 35 Tahun 2009: Perbedaan Pengedar dan Korban Penyalahguna',
                'slug' => 'memahami-uu-no-35-tahun-2009-perbedaan-pengedar-dan-korban',
                'summary' => 'Hukum Indonesia membedakan perlakuan antara bandar/pengedar yang ditindak pidana berat dengan korban penyalahguna yang diarahkan ke rehabilitasi.',
                'content' => "Undang-Undang Republik Indonesia Nomor 35 Tahun 2009 tentang Narkotika merupakan dasar hukum utama dalam pelaksanaan program Pencegahan dan Pemberantasan Penyalahgunaan dan Peredaran Gelap Narkotika (P4GN).\n\n### Sanksi Berat Bagi Bandar & Pengedar\nBagi produsen, kurir, dan bandar narkotika, undang-undang menetapkan hukuman yang sangat berat mulai dari penjara 20 tahun, seumur hidup, hingga pidana mati serta denda miliaran rupiah.\n\n### Pendekatan Humanis Bagi Korban Penyalahguna\nPasal 54 menyatakan bahwa pecandu narkotika dan korban penyalahgunaan narkotika wajib menjalani rehabilitasi medis dan rehabilitasi sosial.\n\nMelalui Tim Asesmen Terpadu (TAT) yang terdiri dari unsur hukum (Polisi, Jaksa, BNN) dan unsur medis (Dokter, Psikolog), penyalahguna murni akan direkomendasikan untuk menjalani pengobatan.",
                'reading_time' => 4,
                'views_count' => 295,
                'is_published' => true,
            ],
            [
                'category_id' => $categories['narkotika-golongan-1']->id,
                'user_id' => $admin->id,
                'title' => 'Mitos Ganja Medis vs Fakta Kerusakan Daya Ingat dan Konsentrasi',
                'slug' => 'mitos-ganja-medis-vs-fakta-kerusakan-daya-ingat',
                'summary' => 'Menjawab simpang siur informasi tentang ganja. Kenali zat psikoaktif Tetrahidrokanabinol (THC) yang merusak memori otak jangka pendek.',
                'content' => "Ganja mengandung senyawa kimia aktif bernama Delta-9-tetrahydrocannabinol (THC) yang terikat langsung pada reseptor kanabinoid di otak.\n\n### Dampak Konsumsi Ganja terhadap Kognisi:\n- **Penurunan IQ Permanen**: Studi membuktikan konsumsi ganja pada usia muda menyebabkan penurunan skor IQ hingga 8 poin.\n- **Sindrom Amotivasional**: Kehilangan semangat hidup, apatis, dan tidak memiliki dorongan untuk mencapai tujuan masa depan.\n- **Pemicu Skizofrenia**: Bagi individu dengan riwayat keluarga tertentu, ganja mempercepat timbulnya episode psikotik dan halusinasi akut.",
                'reading_time' => 3,
                'views_count' => 380,
                'is_published' => true,
            ],
            [
                'category_id' => $categories['dampak-fisik-psikis']->id,
                'user_id' => $admin->id,
                'title' => 'Siklus Adiksi Narkoba: Mengapa Pecandu Sulit Berhenti Sendiri?',
                'slug' => 'siklus-adiksi-narkoba-mengapa-pecandu-sulit-berhenti-sendiri',
                'summary' => 'Adiksi bukanlah kelemahan moral melainkan penyakit otak kronis yang kambuhan (relapsing brain disease). Diperlukan intervensi medis profesional.',
                'content' => "Banyak orang mengira berhenti dari narkoba semata-mata soal niat dan kemauan. Padahal secara biologis, zat adiktif telah merestrukturisasi sirkuit imbalan (reward system) di dalam otak.\n\n### Tiga Tahapan Siklus Adiksi:\n1. **Binge & Intoxication**: Sensasi kenikmatan semu saat zat dikonsumsi.\n2. **Withdrawal & Negative Affect (Sakaw)**: Kondisi sakit fisik, menggigil, nyeri sendi hebat, dan kecemasan tak tertahankan ketika kadar zat menurun.\n3. **Preoccupation & Anticipation (Craving)**: Dorongan obsesif dan dorongan tak terkendali untuk mencari obat kembali demi meredakan penderitaan sakaw.\n\nInilah alasan mengapa pecandu membutuhkan detoksifikasi medis terawasi di klinik BNN.",
                'reading_time' => 5,
                'views_count' => 310,
                'is_published' => true,
            ],
        ];

        foreach ($articlesData as $aData) {
            Article::create($aData);
        }

        // 4. Create Sample Feedbacks
        Feedback::create([
            'user_id' => $user1->id,
            'name' => 'Bella Nurfadilah',
            'email' => 'bella@gmail.com',
            'subject' => 'Pertanyaan Jadwal Sosialisasi P4GN di Sekolah SMA',
            'message' => 'Selamat pagi BNN Kota Jakarta Timur. Kami dari OSIS ingin menanyakan prosedur dan jadwal permohonan narasumber sosialisasi bahaya narkoba untuk kegiatan MPLS sekolah kami. Terima kasih.',
            'status' => 'replied',
            'admin_reply' => 'Halo Kak Bella, permohonan penyuluhan dapat diajukan dengan mengirimkan surat resmi dari pihak sekolah ke Kantor BNN Kota Jakarta Timur atau via email resmi kami di info@bnn-jaktim.go.id minimal 2 minggu sebelum acara. Tim Seksi Pencegahan siap hadir.',
            'replied_at' => now()->subDay(),
            'replied_by' => $admin->id,
        ]);

        Feedback::create([
            'user_id' => $user2->id,
            'name' => 'Rizky Pratama',
            'email' => 'user@gmail.com',
            'subject' => 'Apresiasi Aplikasi Edukasi Narkoba BNN Jaktim',
            'message' => 'Aplikasi artikel bahaya narkoba ini sangat bermanfaat dan mudah diakses di smartphone. Informasinya sangat jelas untuk tugas sekolah dan edukasi teman-teman sebaya.',
            'status' => 'pending',
        ]);

        // 5. Create Sample Bookmarks
        $allArticles = Article::all();
        if ($allArticles->count() >= 2) {
            Bookmark::create([
                'user_id' => $user1->id,
                'article_id' => $allArticles[0]->id,
            ]);
            Bookmark::create([
                'user_id' => $user1->id,
                'article_id' => $allArticles[1]->id,
            ]);
        }
    }
}
