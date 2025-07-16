<?php

namespace App\Services;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class UsernameUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) || 
            (count($credentials) === 1 && 
             array_key_exists('password', $credentials))) {
            return null;
        }

        // First try by username if it exists in credentials
        if (isset($credentials['username'])) {
            $query = $this->newModelQuery();
            $query->where('username', $credentials['username']);
            $user = $query->first();
            if ($user) {
                return $user;
            }
        }

        // Then try by email (standard behavior)
        if (isset($credentials['email'])) {
            $query = $this->newModelQuery();
            $query->where('email', $credentials['email']);
            return $query->first();
        }

        // If both username and email are missing, fall back to Laravel's default behavior
        return parent::retrieveByCredentials($credentials);
    }
}
