<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalArticles = Article::count();
        $totalCategories = Category::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalFeedback = Feedback::count();
        $pendingFeedback = Feedback::where('status', 'pending')->count();
        $totalViews = Article::sum('views_count');

        $recentFeedbacks = Feedback::latest()->take(5)->get();
        $recentArticles = Article::with('category')->latest()->take(5)->get();
        $categoriesWithCount = Category::withCount('articles')->get();

        return view('admin.dashboard', compact(
            'totalArticles',
            'totalCategories',
            'totalUsers',
            'totalFeedback',
            'pendingFeedback',
            'totalViews',
            'recentFeedbacks',
            'recentArticles',
            'categoriesWithCount'
        ));
    }
}
