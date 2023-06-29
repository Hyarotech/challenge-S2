<?php

namespace App\Middlewares;

use Core\Request;
use Core\Router;
use Core\Session;

class GuestMiddleware extends \Core\Middleware
{
    public function handle(Request $request): void
    {
        if (Session::has("user")) {
            Router::redirectTo("home");
        }
    }
}
