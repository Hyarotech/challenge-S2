<?php

namespace App\Requests\User;

use Core\Router;
use Core\Session;
use Core\Verificator;

// A modifier

class GetUserRequest extends \Core\Request
{

    public function __construct()
    {
        parent::__construct();
        $this->setMethod("GET");
        if(empty($this->getData())){
            
        }
    }

}