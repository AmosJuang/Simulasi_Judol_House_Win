<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GamblingController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Gambling routes
    Route::middleware('auth')->group(function () {
        Route::get('/gambling', [GamblingController::class, 'index'])->name('gambling.index');
        Route::post('/gambling/play', [GamblingController::class, 'play'])->name('gambling.play');
        Route::get('/gambling/statistics', [GamblingController::class, 'statistics'])->name('gambling.statistics');
        Route::get('/gambling/roulette', [GamblingController::class, 'roulette'])->name('gambling.roulette');
        Route::post('/gambling/roulette/play', [GamblingController::class, 'playRoulette'])->name('gambling.roulette.play');
        
        // Admin routes
        Route::middleware('admin')->group(function () {
            Route::get('/gambling/admin', [GamblingController::class, 'admin'])->name('gambling.admin');
            Route::get('/gambling/force-result/{user}', [GamblingController::class, 'forceResult'])->name('gambling.forceResult');
            Route::post('/gambling/update-force-result', [GamblingController::class, 'updateForceResult'])->name('gambling.updateForceResult');
            Route::post('/gambling/adjust-balance', [GamblingController::class, 'adjustBalance'])->name('gambling.adjustBalance');
        });
    });
});
