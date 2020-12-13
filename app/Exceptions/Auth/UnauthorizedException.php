<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use Illuminate\Http\Response;

class UnauthorizedException
{
    /** @var int $code */
    protected $code = Response::HTTP_UNAUTHORIZED;
}