<?php

namespace App\Controllers\Security;

use App\Requests\Security\ForgotPasswordRequest;
use Core\Request;
use Core\Resource;

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


    public function forgot_password(): Resource
    {
        return new Resource("Auth/forgot_password", "front");
    }

    public function reset_password(): Resource
    {
        return new Resource("Auth/reset_password", "front");
    }
}
