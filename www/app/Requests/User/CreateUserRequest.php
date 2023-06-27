<?php

namespace App\Requests\User;

use App\Forms\User\CreateUserForm;
use Core\Router;
use Core\Session;
use Core\Verificator;

class CreateUserRequest extends \Core\Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $form = new CreateUserForm();
        $errors = Verificator::form($form->getConfig(), $this->getData());
        Session::set("errors", $errors);
        if(!empty($errors)) {
            Session::set("old", $this->getData());
            Router::redirectTo("security.register");
        }
    }

}