<?php

use App\Controllers\HomeController;
use Core\Router;

$router = Router::getInstance();
$router->get("/", [HomeController::class, "index"])->setName("home");
$router->get("/admin", [HomeController::class, "dashboard"])->setName("admin");
$router->get("/contact", [HomeController::class, "contact"])->setName("contact");




include ROOT . "/routes/errors.routes.php";
include ROOT . "/routes/pages.routes.php";
include ROOT . "/routes/security.routes.php";
include ROOT . "/routes/comment.routes.php";
include ROOT . "/routes/install.routes.php";
include ROOT . "/routes/users.routes.php";
include ROOT . "/routes/categories.routes.php";
include ROOT . "/routes/admin.settings.routes.php";
