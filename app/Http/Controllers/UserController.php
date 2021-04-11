<?php

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionDeniedException;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends ApiController
{
    public function __construct(ApiResponse $apiResponse)
    {
        parent::__construct($apiResponse);
    }

    /**
     * @throws PermissionDeniedException
     */
    public function index(Request $request): JsonResponse
    {
        if(!$request->user()->can('Manage users')) {
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
        if(!$request->user()->can('Manage users')) {
            throw new PermissionDeniedException();
        }
        return $this->apiResponse
            ->setData((array)new UserResource($user))
            ->getResponse();
    }

    /**
     * @throws PermissionDeniedException
     */
    public function deactivateUser(Request $request, User $user): JsonResponse
    {
        if(!$request->user()->can('Manage users')) {
            throw new PermissionDeniedException();
        }
        try {
            $user->is_active = false;
            $user->save();
        } catch(\Exception) {
            return $this->apiResponse->setFailureStatus(50)
            ->setMessage("There was an problem while deactivating an user")
            ->getResponse();
        }
        return $this->apiResponse
            ->setData((array)new UserResource($user))
            ->getResponse();
    }
}
