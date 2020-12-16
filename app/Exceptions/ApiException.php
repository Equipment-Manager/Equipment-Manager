<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

abstract class ApiException extends Exception
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
