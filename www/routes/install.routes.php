<?php
use Core\Router;

$router = Router::getInstance();
$router->get("/install", [\App\Controllers\InstallController::class, "index"])->setName("install");
$router->get("api/install/step1", [\App\Controllers\InstallController::class, "index"])->setName("install");