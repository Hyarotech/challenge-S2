<?php

namespace App\Middlewares;

use App\Models\User;
use Core\Middleware;
use Core\Request;
use Core\Role;
use Core\Router;
use Core\Session;

class AdminMiddleware extends Middleware
{

    public function handle(Request $request): void
    {
        $user = Session::get("user");
        $userInDb = User::findOne($user["id"]);
        if ($userInDb->getRole() !== Role::ADMIN) {
            Router::redirectTo("errors.404");
        }
    }
}