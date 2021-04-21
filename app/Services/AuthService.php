<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Auth\UnauthorizedException;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Support\Collection;

class AuthService
{
    protected Hasher $hasher;
    protected Translator $translator;

    public function __construct(Hasher $hasher, Translator $translator)
    {
        $this->hasher = $hasher;
        $this->translator = $translator;
    }

    /**
     * @throws UnauthorizedException
     */
    public function login(array $data): string
    {
        $user = User::query()->active()->where("email", $data["email"])->first();
        if (!$user || !$this->hasher->check($data["password"], $user->password)) {
            throw new UnauthorizedException($this->translator->get("auth.failed"));
        }

        return $user->createToken($data["email"])->plainTextToken;
    }

    public function userPermissions(User $user): Collection
    {
        return $user->getPermissionsViaRoles()->unique("id");
    }
}
