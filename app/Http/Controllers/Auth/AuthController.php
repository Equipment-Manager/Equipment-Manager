<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends ApiController
{
    protected AuthService $authService;
    protected Translator $translator;

    public function __construct(ApiResponse $apiResponse, AuthService $authService, Translator $translator)
    {
        parent::__construct($apiResponse);
        $this->authService = $authService;
        $this->translator = $translator;
    }

    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $data = $loginRequest->only("email", "password");

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("auth.login.success"))
            ->setData([
                "token" => $this->authService->login($data),
            ])
            ->getResponse();
    }

    public function authUser(Request $request): JsonResponse
    {
        $permissions = $this->authService->userPermissions($request->user());

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("auth.login.success"))
            ->setData([
                "user" => new UserResource($request->user()),
                "permissions" => $permissions,
            ])
            ->getResponse();
    }
}
