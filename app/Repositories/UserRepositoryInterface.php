<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function storeUser(array $userData): void;

    public function getUser(string $email): array;

    public function getAllUsers(): array;
}
