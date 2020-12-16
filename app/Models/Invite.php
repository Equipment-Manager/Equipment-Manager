<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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
        return $query->where("status", "pending");
    }
}
