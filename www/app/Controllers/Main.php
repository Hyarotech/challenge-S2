<?php
namespace App\Controllers;
use Core\View;

class Main{
    public function index(){

        $pseudo = "Prof";
        $view = new View("Main/index", "front");
        $view->assign("pseudo", $pseudo);
    }

    public function contact(){
        $view = new View("Main/contact", "front");
    }

    public function dashboard(){
        $pseudo = "Prof";
        $view = new View("Main/dashboard", "back");
        $view->assign("pseudo", $pseudo);
        
    }
}