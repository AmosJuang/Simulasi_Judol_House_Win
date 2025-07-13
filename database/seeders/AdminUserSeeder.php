<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@casino.com'],
            [
                'name' => 'Casino Admin',
                'email' => 'admin@casino.com',
                'password' => Hash::make('admin123'),
                'balance' => 1000000,
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create test user
        User::updateOrCreate(
            ['email' => 'player@casino.com'],
            [
                'name' => 'Test Player',
                'email' => 'player@casino.com', 
                'password' => Hash::make('player123'),
                'balance' => 100000,
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );
    }
}
