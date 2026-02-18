<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ForumController::class, 'index'])->name('home.index');

Route::get('/registr', [AuthController::class, 'registr'])->name('user.create');
Route::post('/registr', [AuthController::class, 'store'])->name('user.store');