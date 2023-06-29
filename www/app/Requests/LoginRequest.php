<?php

namespace App\Requests;

use App\Forms\Security\LoginForm;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;

class LoginRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $loginForm = new LoginForm();
        $errors = Verificator::form($loginForm->getConfig(), $this->getData());
        Session::set("errors", $errors);
        if(!empty($errors)) {
            Session::set("old", $this->getData());
            Router::redirectTo("security.login");
        }
    }

}
