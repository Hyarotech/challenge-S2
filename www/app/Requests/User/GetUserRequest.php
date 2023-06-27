<?php

namespace App\Requests\User;

use Core\Router;
use Core\Session;
use Core\Verificator;

class GetUserRequest extends \Core\Request
{
    protected $userId;

    public function __construct($userId)
    {
        parent::__construct();
        $this->setMethod("GET");
        $this->userId = $userId;
    }

}