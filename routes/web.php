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

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Gambling routes
    Route::prefix('gambling')->name('gambling.')->group(function () {
        Route::get('/', [GamblingController::class, 'index'])->name('index');
        Route::post('/play', [GamblingController::class, 'play'])->name('play');
        Route::get('/statistics', [GamblingController::class, 'statistics'])->name('statistics');
        Route::get('/roulette', [GamblingController::class, 'roulette'])->name('roulette');
        Route::post('/roulette/play', [GamblingController::class, 'playRoulette'])->name('roulette.play');
        
        // Admin only routes
        Route::middleware(['admin'])->group(function () {
            Route::get('/admin', [GamblingController::class, 'admin'])->name('admin');
            Route::get('/admin/force/{user}', [GamblingController::class, 'forceResult'])->name('forceResult');
            Route::post('/admin/force-result', [GamblingController::class, 'updateForceResult'])->name('updateForceResult');
            Route::post('/admin/adjust-balance', [GamblingController::class, 'adjustBalance'])->name('adjustBalance');
        });
    });
});
