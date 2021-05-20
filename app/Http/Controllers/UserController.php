<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\EditUserRequest;
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

    /**
     * @throws PermissionDeniedException|Exception
     */
    public function edit(EditUserRequest $request, User $user): JsonResponse
    {
        if (!$user->is($request->user()) || !$request->user()->can("Manage users")) {
            throw new PermissionDeniedException();
        }
        $data = $request->only(["email", "first_name", "last_name"]);
        $this->userService->editUser($user, $data);

        return $this->apiResponse
            ->setMessage($this->translator->get("user.edited"))
            ->setData((array)new UserResource($user))
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException|Exception
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $data = $request->only("current_password", "password");
        $this->userService->changePassword($request->user(), $data);

        return $this->apiResponse
            ->setMessage($this->translator->get("user.password.changed"))
            ->setData([])
            ->getResponse();
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $path = $request->file("avatar")->store("/avatars");

        $this->userService->updateAvatar($request->user(), $path);

        return $this->apiResponse
            ->setMessage($this->translator->get("user.avatar.uploaded"))
            ->setData(
                [
                    "path" => asset($path),
                ]
            )
            ->getResponse();
    }
}
