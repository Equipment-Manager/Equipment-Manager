<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RolesService
{
    public function index(): Collection
    {
        return Role::query()
            ->with("permissions")
            ->get();
    }

    public function show(int $id): Builder | Model
    {
        return Role::query()
            ->with("permissions")
            ->where("id", $id)
            ->firstOrFail();
    }

    public function add(array $data): void
    {
        Role::create([
            "name" => $data["name"],
            "guard_name" => "web",
        ]);
    }

    public function edit(int $id, array $data): void
    {
        /** @var Role $role */
        $role = $this->show($id);

        $role->name = $data["name"];
        $role->save();
    }

    public function delete(int $id): void
    {
        Role::query()
            ->where("id", $id)
            ->delete();
    }

    public function syncPermissions(int $id, array $data): void
    {
        /** @var Role $role */
        $role = $this->show($id);

        $role->syncPermissions($data["permissions"]);
    }
}
