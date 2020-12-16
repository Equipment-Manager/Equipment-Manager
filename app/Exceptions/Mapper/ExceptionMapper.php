<?php

declare(strict_types=1);

namespace App\Exceptions\Mapper;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class ExceptionMapper
{
    public function mapCode(Throwable $exception): int
    {
        $mapping = [
            AuthenticationException::class => Response::HTTP_UNAUTHORIZED,
            ModelNotFoundException::class => Response::HTTP_NOT_FOUND,
            RouteNotFoundException::class => Response::HTTP_NOT_FOUND,
            ValidationException::class => Response::HTTP_UNPROCESSABLE_ENTITY,
            QueryException::class => Response::HTTP_UNPROCESSABLE_ENTITY,
        ];

        foreach ($mapping as $class => $code) {
            if ($exception instanceof $class) {
                return $code;
            }
        }

        if ($exception->getCode()) {
            return $exception->getCode();
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    public function mapMessage(Throwable $exception): string
    {
        $mapping = [
            AuthenticationException::class => "Unauthorized",
            ModelNotFoundException::class => "Model not found",
            RouteNotFoundException::class => "Route not found",
        ];

        foreach ($mapping as $class => $message) {
            if ($exception instanceof $class) {
                return $message;
            }
        }

        if ($exception->getMessage()) {
            return $exception->getMessage();
        }

        return "Internal server error";
    }

    public function mapData(Throwable $exception): array
    {
        if (method_exists($exception, "errors")) {
            return $exception->errors();
        }

        return [];
    }

}