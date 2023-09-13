<?php

define("ROOT", dirname(__DIR__));
require ROOT . "/vendor/autoload.php";

use Core\App;
use Core\Router;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$app = new App(Router::getInstance());