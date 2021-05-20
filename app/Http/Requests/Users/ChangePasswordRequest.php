<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "current_password" => ["required"],
            "password" => ["required", "confirmed", Password::min(8)],
        ];
    }
}
