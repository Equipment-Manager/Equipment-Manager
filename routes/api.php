<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router = app(Router::class);

$router->middleware("auth:sanctum")->group(
    function (Router $router): void {
        $router->get("/auth/user", [AuthController::class, "authUser"]);
        $router->post("/invite", [InviteController::class, "invite"]);
        $router->post("/invite/cancel/{token}", [InviteController::class, "cancel"]);

        $router->get("/roles", [RolesController::class, "all"]);
        $router->get("/roles/{id}", [RolesController::class, "get"]);
        $router->post("/roles/add", [RolesController::class, "add"]);
        $router->put("/roles/edit/{id}", [RolesController::class, "edit"]);
        $router->put("/roles/sync/{id}", [RolesController::class, "syncPermissions"]);
        $router->delete("/roles/delete/{id}", [RolesController::class, "delete"]);

        $router->get("/users", [UserController::class, "index"]);
        $router->get("/user/{user}", [UserController::class, "show"]);
        $router->put("/user/edit/{user}", [UserController::class, "edit"]);
        $router->post("/user/change-password", [UserController::class, "changePassword"]);
        $router->post("/users/deactivate/{user}", [UserController::class, "deactivateUser"]);
        $router->post("/user/avatar/upload", [UserController::class, "uploadImage"]);

        $router->get("/permissions", [PermissionsController::class, "index"]);
    }
);

$router->post("/auth/login", [AuthController::class, "login"]);
$router->post("/invite/accept/{token}", [InviteController::class, "accept"]);
