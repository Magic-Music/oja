<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function storeUser(array $userData): void;

    public function getUser(string $email): User;

    public function getAllUsers(): Collection;
}
