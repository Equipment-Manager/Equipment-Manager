<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(Gate $gate): void
    {
        $gate->after(function (User $user, string $ability): bool {
            return $user->hasRole("Admin");
        });
    }
}
