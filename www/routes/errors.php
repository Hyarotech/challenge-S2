<?php
$router = \Core\Router::getInstance();
$router->get("/404",[App\Controllers\ErrorsController::class, "notFound"])->setName("errors.404");