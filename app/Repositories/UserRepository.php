<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function storeUser(array $userData): void
    {
        User::create($userData);
    }

    public function getUser(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getAllUsers(): Collection
    {
        return User::all();
    }
}
