<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as LaravelUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property string $email
 * @property string $password
 * @property bool $is_active
 * @property Carbon $email_verified_at
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $modified_at
 */
class User extends LaravelUser
{
    use Notifiable;
    use HasApiTokens;
    use HasFactory;
    use HasPermissions;
    use HasRoles;

    public const DEFAULT_AVATAR = "avatar/default-avatar.png";

    protected $fillable = [
        "name",
        "surname",
        "avatar",
        "email",
        "password",
    ];
    protected $hidden = [
        "password",
        "remember_token",
    ];
    protected $casts = [
        "email_verified_at" => "datetime",
        "is_active" => "boolean",
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where("is_active", true);
    }
}
