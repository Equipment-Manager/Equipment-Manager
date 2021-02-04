<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Role;
use App\Observers\RoleObserver;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * @throws RuntimeException
     */
    public function boot(): void
    {
        Role::observe(RoleObserver::class);
    }
}
