<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\Roles\AddRoleRequest;
use App\Http\Requests\Roles\EditRoleRequest;
use App\Services\RolesService;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RolesController extends ApiController
{
    protected RolesService $rolesService;
    protected Translator $translator;

    public function __construct(ApiResponse $apiResponse, RolesService $rolesService, Translator $translator)
    {
        parent::__construct($apiResponse);
        $this->rolesService = $rolesService;
        $this->translator = $translator;
    }

    /**
     * @throws PermissionDeniedException
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->can("Manage permissions")) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }

        $roles = $this->rolesService->index();

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("roles.role.index"))
            ->setData([
                "roles" => $roles,
            ])
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException
     */
    public function show(int $id, Request $request): JsonResponse
    {
        if (!$request->user()->can("Manage permissions")) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }

        $role = $this->rolesService->show($id);

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("roles.role.show"))
            ->setData([
                "role" => $role,
            ])
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException
     */
    public function add(AddRoleRequest $request): JsonResponse
    {
        if (!$request->user()->can("Manage permissions")) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }

        $data = $request->only("name");
        $this->rolesService->add($data);

        return $this->apiResponse
            ->setSuccessStatus(Response::HTTP_CREATED)
            ->setMessage($this->translator->get("roles.role.created"))
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException
     */
    public function edit(int $id, EditRoleRequest $request): JsonResponse
    {
        if (!$request->user()->can("Manage permissions")) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }

        $data = $request->only("name");
        $this->rolesService->edit($id, $data);

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("roles.role.changed"))
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException
     */
    public function syncPermissions(int $id, Request $request): JsonResponse
    {
        if (!$request->user()->can("Manage permissions")) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }

        $data = $request->only("permissions");
        $this->rolesService->syncPermissions($id, $data);

        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("roles.role.permissions.synced"))
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException
     */
    public function delete(int $id, Request $request): JsonResponse
    {
        if (!$request->user()->can("Manage permissions")) {
            throw new PermissionDeniedException($this->translator->get("exceptions.auth.forbidden"));
        }

        $this->rolesService->delete($id);
        return $this->apiResponse
            ->setSuccessStatus()
            ->setMessage($this->translator->get("roles.role.deleted"))
            ->getResponse();
    }
}
