<?php

namespace App\Controllers\Security;

use App\Models\User;
use App\Requests\LoginRequest;
use Core\FlashNotifier;
use Core\Resource;
use Core\Router;
use Core\Session;
use Exception;

class SecurityController
{
    public function register(): Resource
    {
        return new Resource("Auth/register", "front");
    }

    public function login(): Resource
    {

        return new Resource("Auth/login", "front");
    }
}
