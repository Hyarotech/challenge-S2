<?php
namespace App\Controllers;
use Core\View;

class HomeController{
    public function index(): View
    {

        $pseudo = "Prof";
        $view = new View("Main/index", "front");
        $view->assign("pseudo", $pseudo);
        return $view;
    }

    public function contact(){
        $view = new View("Main/contact", "front");
    }

    public function dashboard(){
        $pseudo = "test";
        $view = new View("Main/index", "back");
        $view->assign("pseudo", $pseudo);

    }
}