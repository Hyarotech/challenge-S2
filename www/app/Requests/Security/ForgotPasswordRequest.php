<?php

namespace App\Requests\Security;

use Core\Request;
use Core\Router;
use Core\Session;

class ForgotPasswordRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        if(empty($this->getData()) || !isset($this->getData()["email"]) || empty($this->getData()["email"])) {
            Session::set("errors", ["email" => "Veuillez renseigner votre email"]);
            Router::redirectTo("security.forgotPassword.handle");
        }
    }
}
