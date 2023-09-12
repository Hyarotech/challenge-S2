<?php

use App\Controllers\Security\SecurityController;
use Core\Router;

$router = Router::getInstance();
$router->get("/login", [SecurityController::class, "login"])->setName("security.login")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->post("/login", [SecurityController::class, "loginHandle"])->setName("security.login.handle")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->get("/logout", [SecurityController::class, "logout"])->setName("security.logout")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->get("/register", [SecurityController::class, "register"])->setName("security.register")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->post("/register", [SecurityController::class, "registerHandle"])->setName("security.register.handle")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->get("/verif_email/:token/:email", [SecurityController::class, "verifEmail"])->setName("security.verifEmail");
$router->get("/profile",[SecurityController::class, "profile"])->setName("security.profile")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);