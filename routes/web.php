<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // All routes inside this group require authentication
    Route::resource('articles', ArticleController::class)->except(['index']);
    // Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    // Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    // Route::get('/articles/{id}/edit', [ArticleController::class, 'edit']);
    // Route::put('/articles/{id}', [ArticleController::class, 'update']);
    // Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
    // Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
});

// Public routes outside the middleware group
//Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
// Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
