<?php

use App\Controllers\InstallController;
use Core\Router;

$router = Router::getInstance();
$router->get("/install", [InstallController::class, "index"])->setName("install");
$router->post("/api/install",[InstallController::class,'install'])->setName("install.final");
$router->get("/api/install/state", [InstallController::class, "getStateInstall"])->setName("install.state");
$router->post('/api/install/db',[InstallController::class, "installDb"])->setName("install.db");
$router->post('/api/install/settings',[InstallController::class, "installSettings"])->setName("install.settings");
$router->post('/api/install/smtp',[InstallController::class, "installSmtp"])->setName("install.smtp");
$router->post('/api/install/admin',[InstallController::class, "installAdmin"])->setName("install.admin");