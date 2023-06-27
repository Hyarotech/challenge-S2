<?php

use App\Controllers\Security\SecurityController;
use App\Controllers\Security\SecurityControllerApi;
use Core\Router;

$router = Router::getInstance();
$router->get("/login", [SecurityController::class, "login"])->setName("security.login")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->post("/login", [SecurityControllerApi::class, "login"])->setName("security.login.handle")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->get("/logout", [SecurityControllerApi::class, "logout"])->setName("security.logout")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->get("/register", [SecurityController::class, "register"])->setName("security.register")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->post("/register", [SecurityControllerApi::class, "register"])->setName("security.register.handle")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->get("/verif_email/:token/:email", [SecurityControllerApi::class, "verifEmail"])->setName("security.verifEmail");

