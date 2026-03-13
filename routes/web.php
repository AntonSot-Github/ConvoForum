<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ForumController::class, 'index'])->name('home.index');

Route::get('/topics', [TopicController::class, 'index'])->name('topics.list');
Route::get('/{topic}/show', [TopicController::class, 'show'])->name('topic.show');

Route::middleware(['auth', 'verified'])->prefix('/posts')->group(function () {
    Route::get('/post/create', [PostController::class, 'createPost'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.delete');
    Route::get('/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('post.update');
});

Route::middleware('auth')->prefix('/profile')->group(function () {
    Route::get('', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/phone', [ProfileController::class, 'updatePhone'])->name('profile.update.phone');
    Route::patch('/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::delete('', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
