<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'balance',
        'total_attempts',
        'total_wins',
        'total_losses',
        'is_admin',
        'forced_result',
        'last_played_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_played_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'balance' => 'integer',
            'total_attempts' => 'integer',
            'total_wins' => 'integer',
            'total_losses' => 'integer',
        ];
    }

    /**
     * Boot function for the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        // Auto-generate a username based on name if not provided
        static::creating(function ($user) {
            if (empty($user->username)) {
                // Generate a slug from the name and add a random string
                $user->username = Str::slug($user->name) . '-' . Str::random(5);
            }
        });
    }
}
