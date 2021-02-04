<?php

declare(strict_types=1);

namespace App\Tests\Contexts;

use App\Models\Role;
use App\Tests\Traits\Authorization;
use App\Tests\Traits\PreparingUsers;
use App\Tests\Traits\RebuildingApp;
use App\Tests\Traits\RegisteringPermissions;
use App\Tests\Traits\Requesting;
use Behat\Behat\Context\Context;
use KrzysztofRewak\Larahat\Helpers\RefreshingDatabase;

class RoleContext implements Context
{
    use RebuildingApp;
    use Requesting;
    use RefreshingDatabase;
    use Authorization;
    use RegisteringPermissions;
    use PreparingUsers;

    /**
     * @Then a role with :name should be created
     */
    public function aRoleWithShouldBeCreated(string $name): void
    {
        Role::query()
            ->where("name", $name)
            ->firstOrFail();
    }
}
