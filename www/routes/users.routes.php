<?php
$router = \Core\Router::getInstance();

$router->get("/admin/users",[\App\Controllers\Admin\UsersController::class, 'viewAll'])->setName("admin.users.viewAll");
$router->get("/admin/users/create",[\App\Controllers\Admin\UsersController::class, "create"])->setName("admin.users.create");
$router->post("/admin/users",[\App\Controllers\Admin\UsersController::class, "createHandle"])->setName("admin.users.create.handle");
$router->get("/admin/users/:id",[\App\Controllers\Admin\UsersController::class, "viewOne"])->setName("admin.users.viewOne");
$router->get("/admin/users/update/:id",[\App\Controllers\Admin\UsersController::class, "update"])->setName("admin.users.update");
$router->post("/admin/users/:id",[\App\Controllers\Admin\UsersController::class, "updateHandle"])->setName("admin.users.update.handle");
$router->get("/admin/users/delete/:id",[\App\Controllers\Admin\UsersController::class, "delete"])->setName("admin.users.delete");