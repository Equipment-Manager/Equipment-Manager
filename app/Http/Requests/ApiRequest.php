<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;

abstract class ApiRequest extends FormRequest
{
    protected ApiResponse $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        parent::__construct();

        $this->apiResponse = $apiResponse;
    }
}
