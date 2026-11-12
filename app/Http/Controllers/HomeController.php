<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        $categories = Category::withCount('publishedArticles')->get();
        
        $featuredArticles = Article::with('category')
            ->where('is_published', true)
            ->latest()
            ->take(5)
            ->get();

        $popularArticles = Article::with('category')
            ->where('is_published', true)
            ->orderBy('views_count', 'desc')
            ->take(4)
            ->get();

        $latestArticles = Article::with('category')
            ->where('is_published', true)
            ->latest()
            ->skip(5)
            ->take(6)
            ->get();

        return view('home', compact('categories', 'featuredArticles', 'popularArticles', 'latestArticles'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
