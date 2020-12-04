<?php

declare(strict_types=1);

namespace App\Http\Requests;

class RegisterRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "password" => "required|confirmed",
            "name" => "required",
        ];
    }
}
