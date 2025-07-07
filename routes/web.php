<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Gambling routes
    Route::get('/gambling', [App\Http\Controllers\GamblingController::class, 'index'])->name('gambling.index');
    Route::post('/gambling/play', [App\Http\Controllers\GamblingController::class, 'play'])->name('gambling.play');
    Route::get('/gambling/statistics', [App\Http\Controllers\GamblingController::class, 'statistics'])->name('gambling.statistics');

    // Admin routes
    Route::get('/gambling/admin', [App\Http\Controllers\GamblingController::class, 'admin'])->name('gambling.admin');
    Route::get('/gambling/force-result/{user}', [App\Http\Controllers\GamblingController::class, 'forceResult'])->name('gambling.forceResult');
    Route::post('/gambling/update-force-result', [App\Http\Controllers\GamblingController::class, 'updateForceResult'])->name('gambling.updateForceResult');
    Route::post('/gambling/adjust-balance', [App\Http\Controllers\GamblingController::class, 'adjustBalance'])->name('gambling.adjustBalance');
});
