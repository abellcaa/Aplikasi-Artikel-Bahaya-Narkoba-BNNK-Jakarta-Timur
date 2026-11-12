<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('publishedArticles')->get();

        $selectedCategory = null;
        if ($request->filled('category')) {
            $selectedCategory = Category::where('slug', $request->category)->first();
        }

        $query = Article::with(['category', 'author'])
            ->where('is_published', true);

        if ($selectedCategory) {
            $query->where('category_id', $selectedCategory->id);
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderBy('views_count', 'desc');
        } else {
            $query->latest();
        }

        $articles = $query->paginate(9)->withQueryString();

        return view('articles.index', compact('articles', 'categories', 'selectedCategory', 'sort'));
    }

    public function show(string $slug)
    {
        $article = Article::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment views count
        $article->increment('views_count');

        // Check if bookmarked
        $isBookmarked = false;
        if (Auth::check()) {
            $isBookmarked = $article->isBookmarkedBy(Auth::user());
        }

        // Related articles in same category
        $relatedArticles = Article::with('category')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'isBookmarked', 'relatedArticles'));
    }

    public function download(string $slug)
    {
        $article = Article::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $pdf = Pdf::loadView('articles.pdf', compact('article'))->setPaper('a4');

        return $pdf->download(Str::slug($article->title) . '.pdf');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('q', '');
        $categoryId = $request->input('category_id');

        $categories = Category::all();

        $query = Article::with(['category'])
            ->where('is_published', true);

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('summary', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        $articles = !empty($keyword) || !empty($categoryId)
            ? $query->latest()->paginate(10)->withQueryString()
            : collect();

        return view('search', compact('articles', 'categories', 'keyword', 'categoryId'));
    }
}
