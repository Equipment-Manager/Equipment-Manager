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

    public function login(array $data): string
    {
        $user = User::query()->where("email", $data["email"])->first();
        if (!$user || $this->hasher->check($data["password"], $user->password)) {
        }

        return $user->createToken("auth")->plainTextToken;
    }
}
