<?php

declare(strict_types=1);

namespace App\Http\Helpers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    private bool $success;
    private int $statusCode;
    private string $message;
    private array $data;

    public function getResponse(): JsonResponse
    {
        return response()->json([
            "success" => $this->success,
            "message" => $this->message,
            "data" => $this->data,
        ], $this->statusCode);
    }

    public function setSuccessStatus(int $statusCode = Response::HTTP_OK): ApiResponse
    {
        $this->success = true;
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setFailureStatus(int $statusCode): ApiResponse
    {
        $this->success = false;
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setMessage(string $message): ApiResponse
    {
        $this->message = $message;
        return $this;
    }

    public function setData(array $data): ApiResponse
    {
        $this->data = $data;
        return $this;
    }
}