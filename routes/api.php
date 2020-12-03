<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Routing\Router;

/** @var Router $router $router */
$router = app(Router::class);

$router->post("/auth/login", [AuthController::class, "login"]);