<?php

namespace App\Requests\Users;

use App\Forms\Users\CreateUserForm;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;

class CreateUserRequest extends Request
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
            Router::redirectTo("admin.users.create");
        }
    }
}