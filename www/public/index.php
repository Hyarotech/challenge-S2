<?php

use Core\Router;

require __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../config/app.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


(new Router)();





