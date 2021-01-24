<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use App\Exceptions\ApiException;
use Illuminate\Http\Response;

class PermissionDeniedException extends ApiException
{
    protected $code = Response::HTTP_FORBIDDEN;
}
