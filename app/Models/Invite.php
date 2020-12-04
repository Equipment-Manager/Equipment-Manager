<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        "email", "token",
    ];

    protected $hidden = [
        "status"
    ];

    public function scopePending($query): Collection
    {
        return $query->where("status", "pending");
    }

}
