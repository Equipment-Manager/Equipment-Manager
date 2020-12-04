<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiResponse;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\InviteService;
use Symfony\Component\HttpFoundation\JsonResponse;

class InviteController extends Controller
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
            ->setMessage("Invitation email sent")
            ->getResponse();
    }

    public function accept(string $token, RegisterRequest $request): JsonResponse
    {
        $data = $request->only("password", "name");
        $user = $this->inviteService->accept($token, $data);

        return $this->apiResponse
            ->setSuccessStatus(201)
            ->setData([
                "user" => $user,
            ])
            ->setMessage("User Created.")
            ->getResponse();

    }
}
