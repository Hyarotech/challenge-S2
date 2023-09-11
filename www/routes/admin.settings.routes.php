<?php

use App\Controllers\Settings\MenuController;

use Core\Router;

$router = Router::getInstance();

//Route vers l'editeur de menu 
$router->get("/admin/settings/menu", [MenuController::class, "edit"])->setName("admin.settings.menu");

//Route vers l'editeur de menu 
$router->post("/api/admin/settings/menu/save", [MenuController::class, "save"])->setName("admin.settings.menu.save");
