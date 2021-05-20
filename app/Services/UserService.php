<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class UserService
{
    protected Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function deactivate(User $user): void
    {
        $user->is_active = false;
        $user->save();
    }

    public function updateAvatar(User $user, string $path): void
    {
        $user->avatar = $path;
        $user->save();
    }

    public function editUser(User $user, array $data): void
    {
        $user->update(
            [
                "first_name" => $data,
            ]
        );
    }

    /**
     * @throws PermissionDeniedException
     */
    public function changePassword(User $user, array $data): void
    {
        if (!$this->hasher->check($data["current_password"], $user->password)) {
            throw new PermissionDeniedException();
        }

        $user->password = $this->hasher->make($data["password"]);
        $user->save();
    }
}
