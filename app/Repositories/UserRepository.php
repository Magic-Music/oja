<?php

namespace App\Repositories;

use App\Exceptions\EmailAlreadyExistsException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function storeUser(array $userData): void
    {
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

        throw_if(User::where('email', $userData['email'])->exists(), new EmailAlreadyExistsException('The email address already exists'));

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
