<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Mapper\ExceptionMapper;
use App\Http\Helpers\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        /** @var ExceptionMapper $mapper */
        $mapper = $this->container->make(ExceptionMapper::class);

        return $this->renderJsonResponse($mapper->mapMessage($e), $mapper->mapCode($e), $mapper->mapData($e));
    }

    protected function renderJsonResponse(string $message, int $code, array $data = []): JsonResponse
    {
        /** @var ApiResponse $apiResponse */
        $apiResponse = $this->container->make(ApiResponse::class);

        return $apiResponse
            ->setMessage($message)
            ->setData($data)
            ->setFailureStatus($code)
            ->getResponse();
    }
}
