<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Castables\Equipment\EquipmentProperties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ["name", "category_id", "serial_number", "properties", "user_id"];

    protected $casts = [
        "properties" => EquipmentProperties::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
