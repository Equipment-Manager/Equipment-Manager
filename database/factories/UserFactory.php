<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Contracts\Filesystem\Factory as FileSystemContract;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        /** @var Hasher $hasher */
        $hasher = app(Hasher::class);
        /** @var FileSystemContract $fileSystem */
        $fileSystem = app(FileSystemContract::class);

        return [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "email" => $this->faker->unique()->safeEmail,
            "avatar" => storage_path("default-image.png"),
            "email_verified_at" => now(),
            "password" => $hasher->make("password"),
            "remember_token" => Str::random(10),
        ];
    }
}
