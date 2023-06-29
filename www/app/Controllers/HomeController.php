<?php

namespace App\Controllers;

use App\Models\User;
use Core\Session;
use Core\Resource;

class HomeController
{
    public function index(): Resource
    {
        $pseudo = "Prof";
        $view = new Resource("Main/index", "front");
        $view->assign("pseudo", $pseudo);
        return $view;
    }

    public function contact()
    {
        $view = new Resource("Main/contact", "front");
    }

    public function dashboard()
    {
        $view = new Resource("Main/index", "back");
    }
}
