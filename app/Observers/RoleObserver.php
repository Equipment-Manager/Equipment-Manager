<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Role;

class RoleObserver
{
    public function deleting(Role $role): void
    {
        $role->users()->detach();
        $role->permissions()->detach();
    }
}
