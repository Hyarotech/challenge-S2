<?php
define("ROOT", dirname(__DIR__));

require ROOT . "/vendor/autoload.php";
use Core\Router;
use Core\App;


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$router = new Router();

require_once __DIR__ . "/../routes/web.php";
$app = new App($router, ROOT . "/.env");
$router->run();





