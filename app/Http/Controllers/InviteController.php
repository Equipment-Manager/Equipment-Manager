<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\InviteService;
use Illuminate\Http\Request;
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

    /**
     * @throws PermissionDeniedException
     */
    public function invite(InviteRequest $request): JsonResponse
    {
        if (!$request->user()->can("Manage invites")) {
            throw new PermissionDeniedException(__("exceptions.auth.forbidden"));
        }
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

    /**
     * @throws PermissionDeniedException
     */
    public function cancel(Request $request, string $token): JsonResponse
    {
        if (!$request->user()->can("Manage permissions")) {
            throw new PermissionDeniedException(__("exceptions.auth.forbidden"));
        }
        $this->inviteService->cancel($token);

        return $this->apiResponse
            ->setSuccessStatus(Response::HTTP_OK)
            ->setMessage(__("invite.canceled"))
            ->getResponse();
    }
}
