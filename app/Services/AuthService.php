<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class AuthService
{
    protected Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function login(LoginRequest $loginRequest): string
    {
        $user = User::query()->where("email", $loginRequest->email)->first();
        if (!$user || $this->hasher->check($loginRequest->password, $user->password)) {
        }

        return $user->createToken("auth")->plainTextToken;
    }
}
