<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InviteController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router = app(Router::class);

$router->post("/auth/login", [AuthController::class, "login"]);
$router->get("/auth/user", [AuthController::class, "authUser"])->middleware("auth:sanctum");

$router->post("/invite", [InviteController::class, "invite"])->middleware("auth:sanctum");
$router->post("/invite/accept/{token}", [InviteController::class, "accept"]);
$router->post("/invite/cancel/{token}", [InviteController::class, "cancel"])->middleware("auth:sanctum");
