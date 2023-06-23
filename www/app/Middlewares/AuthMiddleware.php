<?php

namespace App\Middlewares;

use App\Models\User;
use Core\FlashNotifier;
use Core\Request;
use Core\Router;
use Core\Session;

class AuthMiddleware extends \Core\Middleware
{

    public function handle(Request $request): void
    {
        $userSession = Session::get("user");
        if(!$userSession){
            FlashNotifier::error("You must be logged in to access this page");
            Router::redirectTo("security.login");
        }
        $user = User::findby('email',$userSession['email']);
        if(!$user){
            FlashNotifier::error("You must be logged in to access this page");
            Router::redirectTo("security.login");
        }
        $user = User::hydrate($user);
        $token = $user->getAccessToken();
        if(!$token){
            FlashNotifier::error("You must be logged in to access this page");
            Router::redirectTo("security.login");
        }
        if($token !== $userSession['accessToken']){
            FlashNotifier::error("You must be logged in to access this page");
            Router::redirectTo("security.login");
        }
    }
}