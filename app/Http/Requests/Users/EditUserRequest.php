<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiRequest;

class EditUserRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "email" => "email|unique:users",
            "first_name" => "required|string|max:35",
            "last_name" => "required|string|max:35",
        ];
    }
}
