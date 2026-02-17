<?php

namespace App\Http\Controllers;

use App\DTOs\LoginDTO;
use App\DTOs\UserDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request)
    {
        $dto = new UserDTO($request->validated());
        $user = $this->service->register($dto);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function login(LoginRequest $request)
    {
        $dto = new LoginDTO($request->validated());
        $user = $this->service->login($dto);
        if (! $user) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    public function profile()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logged out']);
    }
}
