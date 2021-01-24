<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Invite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InviteFactory extends Factory
{
    protected $model = Invite::class;

    public function definition(): array
    {
        return [
            "email" => $this->faker->unique()->safeEmail,
            "token" => Str::uuid(),
            "status" => "pending",
        ];
    }
}
