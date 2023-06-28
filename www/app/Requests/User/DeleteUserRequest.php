<?php

namespace App\Requests\User;

use Core\Router;
use Core\Session;
use Core\Request;

// A modifier

class DeleteUserRequest extends Request
{

    public function __construct()
    {
        parent::__construct();
        $this->setMethod("GET");
        if(!$this->hasId()){
            echo("erreur id");
        }
    }
}