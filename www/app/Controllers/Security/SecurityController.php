<?php

namespace App\Controllers\Security;

use App\Models\User;
use App\Requests\LoginRequest;
use Core\FlashNotifier;
use Core\ResourceView;
use Core\Router;
use Core\Session;
use Exception;

class SecurityController
{
    public function register(): ResourceView
    {
        return new ResourceView("Auth/register", "front");
    }

    public function login(): ResourceView
    {

        return new ResourceView("Auth/login", "front");
    }
}
