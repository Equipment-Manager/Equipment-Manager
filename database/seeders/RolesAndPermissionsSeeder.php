<?php

declare(strict_types=1);

namespace Database\Seeders;

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
                "name" => "Manage invites",
            ]
        );
        Permission::create(
            [
                "name" => "Manage permissions",
            ]
        );
        Permission::create(
            [
                "name" => "Manage users"
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
