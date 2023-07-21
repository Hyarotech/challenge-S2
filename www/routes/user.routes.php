<?php

use App\Controllers\UserController;
use Core\Router;

$router = \Core\Router::getInstance();
$router->get("user/viewAll", [UserController::class, "viewAll"])->setName("user.viewAll")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->get("user/viewOne/:id", [UserController::class, "viewOne"])->setName("user.viewOne")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->get("/user/create", [UserController::class, "create"])->setName("user.create")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->post("/user/create/:id", [UserController::class, "createHandle"])->setName("user.createHandle")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->get("user/update", [UserController::class, "update"])->setName("user.update")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->post("user/update/:id", [UserController::class, "updateHandle"])->setName("user.updateHandle")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->get("user/delete/:id", [UserController::class, "delete"])->setName("user.delete")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
