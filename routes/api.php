<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router = app(Router::class);

$router->post("/auth/login", [AuthController::class, "login"]);

$router->post("/invite", [InviteController::class, "invite"])->middleware("auth:sanctum");
$router->post("/invite/accept/{token}", [InviteController::class, "accept"]);
$router->post("/invite/cancel/{token}", [InviteController::class, "cancel"])->middleware("auth:sanctum");

$router->get("/roles", [RolesController::class, "all"])->middleware("auth:sanctum");
$router->get("/roles/{id}", [RolesController::class, "get"])->middleware("auth:sanctum");
$router->post("/roles/add", [RolesController::class, "add"])->middleware("auth:sanctum");
$router->put("/roles/edit/{id}", [RolesController::class, "edit"])->middleware("auth:sanctum");
$router->put("/roles/sync/{id}", [RolesController::class, "syncPermissions"])->middleware("auth:sanctum");
$router->delete("/roles/delete/{id}", [RolesController::class, "delete"])->middleware("auth:sanctum");

$router->get("/permissions", [PermissionsController::class, "index"])->middleware("auth:sanctum");
