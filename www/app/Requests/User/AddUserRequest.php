<?php

namespace App\Requests\User;

use App\Forms\User\AddUser;
use Core\Router;
use Core\Session;
use Core\Verificator;

class AddUserRequest extends \Core\Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $form = new AddUser();
        $errors = Verificator::form($form->getConfig(), $this->getData());
        Session::set("errors", $errors);
        if(!empty($errors)) {
            Session::set("old", $this->getData());
            Router::redirectTo("security.register");
        }
    }

}