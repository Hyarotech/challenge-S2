<?php

namespace App\Requests\Users;

use App\Forms\Security\AddUser;
use App\Forms\Users\UpdateUserForm;
use Attribute;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;

#[Attribute]
class UpdateUserRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
        $form = new UpdateUserForm();
        $errors = Verificator::form($form->getConfig(), $this->getData());
        Session::set("errors", $errors);
        if(!empty($errors)) {
            Session::set("old", $this->getData());
            Router::redirectDynamicTo("admin.users.update",["id"=>$this->getData()["id"]]);
        }
    }

}