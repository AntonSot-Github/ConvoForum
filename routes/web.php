<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ForumController::class, 'index'])->name('home.index');

Route::get('/register', [AuthController::class, 'register'])->name('user.create');
Route::post('/registr', [AuthController::class, 'store'])->name('user.store');
Route::get('/login', [AuthController::class, 'loginPage'])->name('user.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
