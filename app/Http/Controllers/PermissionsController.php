<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\Permissions;
use App\Services\PermissionsService;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PermissionsController extends ApiController
{
    protected PermissionsService $permissionsService;
    protected Translator $translator;

    public function __construct(ApiResponse $apiResponse, PermissionsService $permissionsService, Translator $translator)
    {
        parent::__construct($apiResponse);
        $this->permissionsService = $permissionsService;
        $this->translator = $translator;
    }

    /**
     * @throws PermissionDeniedException
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->can(Permissions::MANAGE_PERMISSIONS)) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }

        $permissions = $this->permissionsService->index();

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("permissions.permissions.index"))
            ->setData([
                "permissions" => $permissions,
            ])
            ->getResponse();
    }
}
