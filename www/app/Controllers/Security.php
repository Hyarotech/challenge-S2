<?php

namespace App\Controllers;

use App\Forms\Security\AddUser;
use App\Forms\Security\LoginForm;
use App\Models\User;
use Core\Router;
use Core\Session;
use Core\Verificator;
use Core\View;

class Security
{
    public function register(): View
    {
        return new View("Auth/register", "front");
    }

    public function handleRegister(): void
    {
        $form = new AddUser();
        $errors = Verificator::form($form->getConfig(), $_POST);
        Session::set("errors", $errors);
        if (empty($errors)) {
            $user = new User();
            if($user->alreadyExist($_POST["email"])){
                die("Already exist");
            }
            $user->setEmail($_POST["email"]);
            $user->setFirstname($_POST["firstname"]);
            $user->setLastname($_POST["lastname"]);
            $user->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
            $user->save();
        } else{
            Router::redirectTo("security.register");
        }
    }

    public function login(): View
    {
        return new View("Auth/login", "front");
    }

    public function handleLogin(): void
    {
        $loginForm = new LoginForm();

        Session::set("errors",Verificator::form($loginForm->getConfig(), $_POST));
        $errors = Session::get("errors");
        if (empty($errors)) {
            $user = new User();
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $user->login();
        } else{
            // go back to login page with errors
            Router::redirectTo("security.login");
        }
    }

    public function logout(): void
    {
        echo "Logout";
    }

}