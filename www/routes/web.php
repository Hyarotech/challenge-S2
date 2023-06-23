<?php

$router->get("/", [\App\Controllers\HomeController::class, "index"])->setName("home");
$router->get("/dashboard", [\App\Controllers\HomeController::class, "dashboard"])->setName("dashboard");
$router->get("/contact", [\App\Controllers\HomeController::class, "contact"])->setName("contact");
$router->get("/login", [\App\Controllers\SecurityController::class, "login"])->setName("security.login")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->post("/login", [\App\Controllers\SecurityController::class, "handleLogin"])->setName("security.login.handle")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->get("/logout", [\App\Controllers\SecurityController::class, "logout"])->setName("security.logout")->setMiddlewares([\App\Middlewares\AuthMiddleware::class]);
$router->get("/register", [\App\Controllers\SecurityController::class, "register"])->setName("security.register")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->post("/register", [\App\Controllers\SecurityController::class, "handleRegister"])->setName("security.register.handle")->setMiddlewares([\App\Middlewares\GuestMiddleware::class]);
$router->get("/verif_email/:token/:email", [\App\Controllers\SecurityController::class, "verifEmail"])->setName("security.verifEmail");

include ROOT . "/routes/errors.php";