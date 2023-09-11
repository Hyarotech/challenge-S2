<?php

use App\Controllers\Settings\MenuController;

use Core\Router;

$router = Router::getInstance();

//Route vers l'editeur de menu 
$router->get("/dashboard/settings/menu", [MenuController::class, "edit"])->setName("dashboard.settings.menu");
//Route vers l'editeur de menu 
$router->post("/dashboard/settings/menu/save", [MenuController::class, "save"])->setName("dashboard.settings.menu.save");
