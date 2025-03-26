<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PostController::class, 'index']);

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->except(['index']);
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
});