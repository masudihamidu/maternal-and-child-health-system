<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use App\Models\MaternalCard;


class MaternalCardUserProvider implements UserProvider
{
    protected $model;

    public function __construct(MaternalCard $model)
    {
        $this->model = $model;
    }

    public function retrieveById($identifier)
    {
        return $this->model->where('maternalCard', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token)
    {
        // Implementation for token retrieval if needed
    }

    public function updateRememberToken(UserContract $user, $token)
    {
        // Update remember token if needed
    }

    public function retrieveByCredentials(array $credentials)
    {
        return $this->model->where('maternalCard', $credentials['maternalCard'])->first();
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        return true;
    }

    public function rehashPasswordIfRequired(UserContract $user, array $credentials, bool $force = false)
    {

        return true;
    }

    // Other methods as per the UserProvider interface if needed
}
