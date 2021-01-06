<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public const STATUS_ACCEPTED = "accepted";
    public const STATUS_PENDING = "pending";
    public const STATUS_CANCELED = "canceled";

    protected $fillable = [
        "email", "token", "status",
    ];

    public function scopePending(Builder $query): Builder
    {
        return $query->where("status", self::STATUS_PENDING);
    }
}
