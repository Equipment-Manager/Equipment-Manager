<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            "name" => "name",
            "guard_name" => "web",
        ];
    }

    public function name(string $name): self
    {
        return $this->state([
            "name" => $name,
        ]);
    }
}
