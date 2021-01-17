<?php

declare(strict_types=1);

namespace App\Exceptions\Mapper;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            NotFoundHttpException::class => Response::HTTP_NOT_FOUND,
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
            AuthenticationException::class => __("auth.auth.unauthorized"),
            ModelNotFoundException::class => __("exceptions.model.not_found"),
            RouteNotFoundException::class => __("exceptions.model.not_found"),
            NotFoundHttpException::class => __("exceptions.model.not_found"),
        ];

        foreach ($mapping as $class => $message) {
            if ($exception instanceof $class) {
                return $message;
            }
        }

        if ($exception->getMessage()) {
            return $exception->getMessage();
        }

        return __("exceptions.errors.internal_server_error");
    }

    public function mapData(Throwable $exception): array
    {
        if (method_exists($exception, "errors")) {
            return $exception->errors();
        }

        return [];
    }
}
