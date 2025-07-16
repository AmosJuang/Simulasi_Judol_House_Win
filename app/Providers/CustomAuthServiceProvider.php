<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Services\UsernameUserProvider;
use Illuminate\Auth\EloquentUserProvider;

class CustomAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Override the user provider for 'users' to support username authentication
        Auth::provider('eloquent', function ($app, array $config) {
            return new UsernameUserProvider($app['hash'], $config['model']);
        });
    }
}
