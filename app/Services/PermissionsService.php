<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class PermissionsService
{
    public function index(): Collection
    {
        return Permission::all();
    }
}
