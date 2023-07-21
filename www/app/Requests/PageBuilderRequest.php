<?php
namespace App\Requests;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;

class PageBuilderRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod("POST");
    }

}