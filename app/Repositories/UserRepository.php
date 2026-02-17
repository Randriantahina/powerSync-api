<?php

namespace App\Repositories;

use App\DTOs\UserDTO;
use App\Models\User;

class UserRepository
{
    public function create(UserDTO $dto): User
    {
        $data = [
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ];

        return User::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function find(int $id): ?User
    {
        return User::find($id);
    }
}
