<?php

use App\Controllers\Admin\UsersController;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\AuthMiddleware;
use Core\Router;

$router = Router::getInstance();

$router
    ->get("/admin/users", [UsersController::class, 'viewAll'])
    ->setName("admin.users.viewAll")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
$router
    ->get("/admin/users/create", [UsersController::class, "create"])
    ->setName("admin.users.create")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
$router
    ->post("/admin/users", [UsersController::class, "createHandle"])
    ->setName("admin.users.create.handle")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
$router
    ->get("/admin/users/:id", [UsersController::class, "viewOne"])
    ->setName("admin.users.viewOne")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
$router
    ->get("/admin/users/update/:id", [UsersController::class, "update"])->
    setName("admin.users.update")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
$router
    ->post("/admin/users/:id", [UsersController::class, "updateHandle"])
    ->setName("admin.users.update.handle")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);
$router
    ->post("/api/admin/users/delete", [UsersController::class, "delete"])
    ->setName("api.admin.users.delete")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);