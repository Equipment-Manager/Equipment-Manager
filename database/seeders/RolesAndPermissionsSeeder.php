<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Http\Helpers\Permissions;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(
            [
                "name" => Permissions::MANAGE_INVITES,
            ]
        );
        Permission::create(
            [
                "name" => Permissions::MANAGE_PERMISSIONS,
            ]
        );
        Permission::create(
            [
                "name" => Permissions::MANAGE_USERS,
            ]
        );

        /** @var Role $role */
        $role = Role::create(
            [
                "name" => "Admin",
            ]
        );
        $role->givePermissionTo(Permission::all());

        $user = User::first();
        $user->assignRole("Admin");
    }
}
