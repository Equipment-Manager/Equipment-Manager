<?php

declare(strict_types=1);

namespace App\Tests\Traits;

use App\Models\Permission;
use App\Models\Role;
use Behat\Gherkin\Node\TableNode;
use Spatie\Permission\PermissionRegistrar;

trait RegisteringPermissions
{
    /**
     * @Given the following permissions are created:
     */
    public function theFollowingPermissionsAreCreated(TableNode $table): void
    {
        foreach ($table->getHash() as $permission) {
            Permission::factory()->create($permission);
        }
    }

    /**
     * @Given the following roles are created:
     */
    public function theFollowingRolesAreCreated(TableNode $table): void
    {
        foreach ($table->getHash() as $role) {
            Role::factory()->create($role);
        }
    }

    /**
     * @Given a role :roleName can :ability
     */
    public function aRoleCan(string $roleName, string $ability): void
    {
        $role = Role::query()
            ->where("name", $roleName)
            ->first();

        $permission = Permission::query()
            ->where("name", $ability)
            ->first();

        $role->givePermissionTo($permission);
    }
}
