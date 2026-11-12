<?php

use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public / Mobile User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/pencarian', [ArticleController::class, 'search'])->name('search');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// Kritik & Saran (Feedback)
Route::get('/kritik-saran', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/kritik-saran', [FeedbackController::class, 'store'])->name('feedback.store');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/tersimpan', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/artikel/{article}/simpan', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    Route::get('/artikel/{slug}/unduh', [ArticleController::class, 'download'])->name('articles.download');
    Route::get('/profil', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profil', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// Admin Panel Routes (Protected by role:admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Articles Management
    Route::resource('articles', AdminArticleController::class)->except(['show']);

    // Categories Management
    Route::resource('categories', AdminCategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    // Users Management
    Route::resource('users', AdminUserController::class)->except(['show']);

    // Feedback Management & Email Reply
    Route::get('/feedbacks', [AdminFeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/feedbacks/print', [AdminFeedbackController::class, 'print'])->name('feedbacks.print');
    Route::get('/feedbacks/{feedback}', [AdminFeedbackController::class, 'show'])->name('feedbacks.show');
    Route::post('/feedbacks/{feedback}/reply', [AdminFeedbackController::class, 'reply'])->name('feedbacks.reply');
    Route::delete('/feedbacks/{feedback}', [AdminFeedbackController::class, 'destroy'])->name('feedbacks.destroy');
});
