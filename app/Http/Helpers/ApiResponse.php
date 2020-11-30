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

    public function setSuccessStatus(int $statusCode = Response::HTTP_OK): self
    {
        $this->success = true;
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setFailureStatus(int $statusCode): self
    {
        $this->success = false;
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }
}
