<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

abstract class ApiRequest extends FormRequest
{
    protected ApiResponse $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        parent::__construct();

        $this->apiResponse = $apiResponse;
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            $this->apiResponse
                ->setData([$validator->errors()])
                ->setFailureStatus(Response::HTTP_BAD_REQUEST)
                ->getResponse()
        );
    }
}
