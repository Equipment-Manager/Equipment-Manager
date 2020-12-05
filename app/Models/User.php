<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Foundation\Auth\User as LaravelUser;
use Illuminate\Notifications\Notifiable;

class User extends LaravelUser
{
    use Notifiable;

    protected $fillable = [
        "name",
        "email",
        "password",
    ];
    protected $quarded = [
        "is_verified",
        "is_active",
    ];
    protected $hidden = [
        "password",
        "remember_token",
    ];
    protected $casts = [
        "email_verified_at" => "datetime",
        "is_verified" => "boolean",
        "is_active" => "boolean",
    ];
}
