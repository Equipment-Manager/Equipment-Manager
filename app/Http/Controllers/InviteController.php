<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\Permissions;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\InviteService;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class InviteController extends ApiController
{
    protected InviteService $inviteService;
    protected Translator $translator;

    public function __construct(ApiResponse $apiResponse, InviteService $inviteService, Translator $translator)
    {
        parent::__construct($apiResponse);
        $this->inviteService = $inviteService;
        $this->translator = $translator;
    }

    /**
     * @throws PermissionDeniedException
     */
    public function invite(InviteRequest $request): JsonResponse
    {
        if (!$request->user()->can(Permissions::MANAGE_INVITES)) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }
        $data = $request->only("email");
        $this->inviteService->invite($data);

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("invite.send"))
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
            ->setMessage($this->translator->get("invite.accepted"))
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException
     */
    public function cancel(Request $request, string $token): JsonResponse
    {
        if (!$request->user()->can(Permissions::MANAGE_INVITES)) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }
        $this->inviteService->cancel($token);

        return $this->apiResponse
            ->setSuccessStatus(Response::HTTP_OK)
            ->setMessage($this->translator->get("invite.canceled"))
            ->getResponse();
    }
}
