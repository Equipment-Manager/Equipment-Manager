<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    public function creating(User $user): void
    {
        $user->avatar = "images/default-avatar.png";
    }
}
