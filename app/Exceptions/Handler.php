<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Http\Helpers\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof ApiException) {
            return $this->renderJsonResponse($e->getMessage(), $e->getCode() ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        } elseif ($e instanceof AuthenticationException) {
            return $this->renderJsonResponse("Unauthorized", Response::HTTP_UNAUTHORIZED);
        } elseif ($e instanceof ModelNotFoundException || $e instanceof RouteNotFoundException) {
            return $this->renderJsonResponse("Not found", Response::HTTP_NOT_FOUND);
        } elseif ($e instanceof ValidationException) {
            return $this->renderJsonResponse($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, $e->errors());
        }

        return $this->renderJsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
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
