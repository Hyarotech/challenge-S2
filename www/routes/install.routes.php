<?php
use Core\Router;

$router = Router::getInstance();
$router->get("/install", [\App\Controllers\InstallController::class, "index"])->setName("install");
$router->get("/api/install/state", [\App\Controllers\InstallController::class, "getStateInstall"])->setName("install.state");
$router->post("/api/getvdom", [\App\Controllers\InstallController::class, "getVdom"])->setName("install.getVdom");
$router->post('/api/install/db',[\App\Controllers\InstallController::class, "installDb"])->setName("install.db");