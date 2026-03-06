<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ForumController::class, 'index'])->name('home.index');

Route::get('/post/create', [PostController::class, 'createPost'])->name('post.create');
Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('post.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/phone', [ProfileController::class, 'updatePhone'])->name('profile.update.phone');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
