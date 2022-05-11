<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\Category\CategoryProperties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 * @property CategoryProperties $category_properties
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ["name", "category_properties"];

    protected $casts = [
        "category_properties" => CategoryProperties::class,
    ];

    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }
}
