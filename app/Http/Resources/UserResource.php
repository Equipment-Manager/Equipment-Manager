<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "avatar" => storage_path($this->avatar),
            "email" => $this->email,
            "is_active" => $this->is_active,
        ];
    }
}
