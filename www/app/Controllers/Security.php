<?php
namespace App\Controllers;
use App\Forms\AddUser;
use Core\Verificator;
use Core\View;

class Security{

    public function login(): void
    {
        echo "Login";
    }

    public function register(): void
    {
        $form = new AddUser();
        $view = new View("Auth/register", "front");
        $view->assign('form', $form->getConfig());


        if($form->isSubmit()){
            $errors = Verificator::form($form->getConfig(), $_POST);
            if(empty($errors)){
                echo "Insertion en BDD";
            }else{
                $view->assign('errors', $errors);
            }
        }
        /*
        $user = new User();
        $user->setId(2);
        $user->setEmail("test@gmail.com");
        $user->save();
        */
    }

    public function logout(): void
    {
        echo "Logout";
    }

}