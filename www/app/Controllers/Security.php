<?php

namespace App\Controllers;

use App\Forms\Security\AddUser;
use App\Forms\Security\LoginForm;
use App\Models\User;
use Core\Verificator;
use Core\View;

class Security
{
    public function register(): void
    {
        $form = new AddUser();
        $view = new View("Auth/register", "front");
        $view->assign('form', $form->getConfig());


        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                echo "Insertion en BDD";
            } else {
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

    public function login(): void
    {
        $view = new View("Auth/login", "front");
    }

    public function handleLogin()
    {
        $loginForm = new LoginForm();

        $errors = Verificator::form($loginForm->getConfig(), $_POST);
        if (empty($errors)) {
            $user = new User();
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $user->login();
        } else{
            die("Erreur");
        }
    }

    public function logout(): void
    {
        echo "Logout";
    }

}