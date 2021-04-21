<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class UserService
{
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
}
