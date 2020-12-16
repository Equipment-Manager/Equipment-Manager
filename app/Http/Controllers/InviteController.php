<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Helpers\ApiResponse;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\InviteService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class InviteController extends ApiController
{
    protected InviteService $inviteService;

    public function __construct(ApiResponse $apiResponse, InviteService $inviteService)
    {
        parent::__construct($apiResponse);

        $this->inviteService = $inviteService;
    }

    public function invite(InviteRequest $request): JsonResponse
    {
        $data = $request->only("email");
        $this->inviteService->invite($data);

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage(__("invite.send"))
            ->getResponse();
    }

    public function accept(string $token, RegisterRequest $request): JsonResponse
    {
        $data = $request->only("password", "name");
        $user = $this->inviteService->accept($token, $data);

        return $this->apiResponse
            ->setSuccessStatus(Response::HTTP_CREATED)
            ->setData([
                "user" => $user,
            ])
            ->setMessage(__("invite.accepted"))
            ->getResponse();
    }

    public function cancel(string $token): JsonResponse
    {
        $this->inviteService->cancel($token);

        return $this->apiResponse
            ->setSuccessStatus(Response::HTTP_OK)
            ->setMessage(__("invite.canceled"))
            ->getResponse();
    }
}
