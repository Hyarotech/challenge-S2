<?php

namespace App\Controllers;

use App\Models\User;
use Core\Session;
use Core\ResourceView;

class HomeController
{
    public function index(): ResourceView
    {
        $pseudo = "Prof";
        $view = new ResourceView("Main/index", "front");
        $view->assign("pseudo", $pseudo);
        return $view;
    }

    public function contact()
    {
        $view = new ResourceView("Main/contact", "front");
    }

    public function dashboard()
    {
        $view = new ResourceView("Main/index", "back");
    }
}
