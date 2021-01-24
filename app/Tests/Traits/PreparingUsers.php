<?php

declare(strict_types=1);

namespace App\Tests\Traits;

use App\Models\User;
use Behat\Gherkin\Node\TableNode;

trait PreparingUsers
{
    /**
     * @Given the following users are created:
     */
    public function theFollowingUsersAreCreated(TableNode $table): void
    {
        foreach ($table->getHash() as $user) {
            User::factory()->create($user);
        }
    }
}
