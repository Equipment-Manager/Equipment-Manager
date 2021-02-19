<?php

declare(strict_types=1);

namespace App\Http\Requests\Roles;

use App\Http\Requests\ApiRequest;

class AddRoleRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "",
        ];
    }
}
