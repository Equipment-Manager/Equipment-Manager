<?php

declare(strict_types=1);

namespace App\Tests\Contexts;

use App\Models\Invite;
use App\Tests\Traits\Authorization;
use App\Tests\Traits\FakingMailer;
use App\Tests\Traits\PreparingUsers;
use App\Tests\Traits\RegisteringPermissions;
use App\Tests\Traits\Requesting;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use KrzysztofRewak\Larahat\Helpers\RefreshingDatabase;
use PHPUnit\Framework\Assert;

class InviteContext implements Context
{
    use Requesting;
    use RefreshingDatabase;
    use Authorization;
    use RegisteringPermissions;
    use PreparingUsers;
    use FakingMailer;

    protected Invite $invite;

    /**
     * @Then an invite with :email should be created
     */
    public function anInviteWithShouldBeCreated(string $email): void
    {
        $this->invite = Invite::query()->where("email", $email)->firstOrFail();
    }

    /**
     * @Then an invite status should be :status
     */
    public function anInviteStatusShouldBe(string $status): void
    {
        Assert::assertEquals($status, $this->invite->status);
    }

    /**
     * @Then an invite with token :token should be :status
     */
    public function anInviteWithUuidShouldBe(string $token, string $status): void
    {
        $invite = Invite::query()->where("token", $token)->first();

        Assert::assertEquals($status, $invite->status);
    }

    /**
     * @Given the following invites are created:
     */
    public function theFollowingInvitesAreCreated(TableNode $table): void
    {
        foreach ($table->getHash() as $invite) {
            Invite::factory()->create($invite);
        }
    }
}
