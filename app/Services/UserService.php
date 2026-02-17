<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function register(UserDTO $dto)
    {
        $dto->password = Hash::make($dto->password);

        return $this->repo->create($dto);
    }

    public function login(UserDTO $dto)
    {
        $user = $this->repo->findByEmail($dto->email);
        if (! $user || ! Hash::check($dto->password, $user->password)) {
            return null;
        }

        return $user;
    }
}
