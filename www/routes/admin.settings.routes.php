<?php

use App\Controllers\Settings\MenuController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\AdminMiddleware;
use Core\Router;

$router = Router::getInstance();

//Route vers l'editeur de menu 
$router->get("/admin/settings/menu", [MenuController::class, "edit"])
       ->setName("admin.settings.menu")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

//Route vers l'editeur de menu 
$router->post("/admin/settings/menu/save", [MenuController::class, "save"])
       ->setName("admin.settings.menu.save")
       ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);

