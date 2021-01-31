<?php

declare(strict_types=1);

namespace App\Tests\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\Sanctum;

trait Authorization
{
    protected Authenticatable $user;

    /**
     * @Given a user have role :role
     */
    public function aUserHaveRole(string $role): void
    {
        $this->user->assignRole($role);
    }

    /**
     * @Given a user is logged in as :email
     */
    public function aUserIsLoggedInAs(string $email): void
    {
        /** @var Authenticatable $authenticable */
        $authenticable = User::query()
            ->where("email", $email)
            ->firstOrFail();

        $this->user = $authenticable;

        Sanctum::actingAs($this->user);
    }
}
