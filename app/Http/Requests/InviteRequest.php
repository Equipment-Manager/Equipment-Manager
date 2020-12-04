<?php

declare(strict_types=1);

namespace App\Http\Requests;

class InviteRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "email" => "required|email",
        ];
    }
}
