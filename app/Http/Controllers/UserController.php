<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Translation\Translator;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends ApiController
{
    protected Translator $translator;
    protected UserService $userService;

    public function __construct(ApiResponse $apiResponse, Translator $translator, UserService $userService)
    {
        parent::__construct($apiResponse);
        $this->translator = $translator;
        $this->userService = $userService;
    }

    /**
     * @throws PermissionDeniedException
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->can("Manage users")) {
            throw new PermissionDeniedException();
        }
        $users = User::all();

        return $this->apiResponse
            ->setData((array)new UserCollection($users))
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException
     */
    public function show(Request $request, User $user): JsonResponse
    {
        if (!$request->user()->can("Manage users")) {
            throw new PermissionDeniedException();
        }
        return $this->apiResponse
            ->setData((array)new UserResource($user))
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException|Exception
     */
    public function deactivateUser(Request $request, User $user): JsonResponse
    {
        if (!$request->user()->can("Manage users")) {
            throw new PermissionDeniedException();
        }

        $this->userService->deactivate($user);

        return $this->apiResponse
            ->setMessage($this->translator->get("user.deactivate.success"))
            ->setData((array)new UserResource($user))
            ->getResponse();
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $path = $request->file("avatar")->store("/images", "public");

        $this->userService->updateAvatar($request->user(), $path);

        return $this->apiResponse
            ->setMessage($this->translator->get("user.avatar.uploaded"))
            ->setData(
                [
                    "path" => $path,
                ]
            )
            ->getResponse();
    }
}
