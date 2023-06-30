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
$router->get("/forgot_password", [SecurityController::class,"forgot_password"])->setName("security.forgotPassword");
$router->post("/forgot_password", [SecurityControllerApi::class,"forgot_password"])->setName("security.forgotPassword.handle");
$router->get("/reset_password", [SecurityController::class,"reset_password"])->setName("security.resetPassword");
$router->get("/reset_password/:token/:email", [SecurityController::class,"reset_password"])->setName("security.resetPassword.handle");
$router->get("/reset_password/:token/:email", [SecurityController::class,"reset_password"])->setName("security.resetPassword.handle");
