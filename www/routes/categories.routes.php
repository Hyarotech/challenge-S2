<?php

use App\Middlewares\AdminMiddleware;
use App\Middlewares\AuthMiddleware;

$router = \Core\Router::getInstance();

$router
    ->get("/admin/categories", [\App\Controllers\Admin\CategoryController::class, "index"])
    ->setName("admin.categories.index")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);;
$router
    ->get("/admin/categories/create", [\App\Controllers\Admin\CategoryController::class, "create"])
    ->setName("admin.categories.create")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);;
$router
    ->post("/admin/categories", [\App\Controllers\Admin\CategoryController::class, "handleCreate"])
    ->setName("admin.categories.create.handle")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);;
$router
    ->get("/admin/categories/:id/update", [\App\Controllers\Admin\CategoryController::class, "update"])
    ->setName("admin.categories.update")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);;
$router
    ->post("/admin/categories/:id", [\App\Controllers\Admin\CategoryController::class, "handleUpdate"])
    ->setName("admin.categories.update.handle")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);;
$router
    ->post("/api/admin/categories/delete", [\App\Controllers\Admin\CategoryController::class, "delete"])
    ->setName("api.admin.categories.delete")
    ->setMiddlewares([AuthMiddleware::class, AdminMiddleware::class]);;
