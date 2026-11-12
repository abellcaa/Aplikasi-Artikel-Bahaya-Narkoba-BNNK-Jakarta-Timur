<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookmarks = Bookmark::with(['article.category'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(9);

        return view('articles.saved', compact('bookmarks'));
    }

    public function toggle(Article $article)
    {
        $user = Auth::user();

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('article_id', $article->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $status = 'removed';
            $message = 'Artikel dihapus dari daftar simpan.';
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'article_id' => $article->id,
            ]);
            $status = 'saved';
            $message = 'Artikel berhasil disimpan ke daftar bacaan!';
        }

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'count' => $user->bookmarks()->count(),
            ]);
        }

        return back()->with('success', $message);
    }
}
