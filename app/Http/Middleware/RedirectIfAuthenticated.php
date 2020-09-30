<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\User\UserAuthenticatedException;
use Closure;
use Illuminate\Auth\AuthManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    protected AuthManager $manager;

    public function __construct(AuthManager $manager)
    {
        $this->manager = $manager;
    }

    public function handle(Request $request, Closure $next, ?string $guard = null): Response
    {
        if ($this->manager->guard($guard)->check()) {
            throw new UserAuthenticatedException();
        }

        return $next($request);
    }
}
