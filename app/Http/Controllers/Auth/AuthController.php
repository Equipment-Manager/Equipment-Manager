<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(ApiResponse $apiResponse, AuthService $authService)
    {
        parent::__construct($apiResponse);
        $this->authService = $authService;
        $this->middleware("auth:api", ["except" => ["login"]]);
    }

    public function login(LoginRequest $loginRequest): JsonResponse
    {
        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage("Login Successful")
            ->setData([
                "token" => $this->authService->login($loginRequest),
            ])
            ->getResponse();
    }
}