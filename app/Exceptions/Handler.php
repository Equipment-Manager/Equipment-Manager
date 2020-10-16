<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    public function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            "message" => $exception->getMessage(),
        ], Response::HTTP_UNAUTHORIZED);
    }
}
