<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Http\Helpers\ApiResponse;
use App\Services\PermissionsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PermissionsController extends ApiController
{
    protected PermissionsService $permissionsService;

    public function __construct(ApiResponse $apiResponse, PermissionsService $permissionsService)
    {
        parent::__construct($apiResponse);
        $this->permissionsService = $permissionsService;
    }

    /**
     * @throws PermissionDeniedException
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->can("Manage permissions")) {
            throw new PermissionDeniedException(__("exceptions.auth.forbidden"));
        }

        $permissions = $this->permissionsService->index();

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage(__("permissions.permissions.index"))
            ->setData([
                "permissions" => $permissions,
            ])
            ->getResponse();
    }
}
