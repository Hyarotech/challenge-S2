<?php

namespace App\Requests\User;

use Core\Router;
use Core\Session;
use Core\Request;

// A modifier

class DeleteUserRequest extends Request
{
    protected $userId;

    public function __construct($userId)
    {
        parent::__construct();
        $this->setMethod("DELETE");
        $this->userId = $userId;
    }
}