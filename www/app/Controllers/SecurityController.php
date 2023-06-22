<?php

namespace App\Controllers;

use App\Forms\Security\AddUser;
use App\Forms\Security\LoginForm;
use App\Models\User;
use Core\enums\Role;
use Core\Router;
use Core\Session;
use Core\Verificator;
use Core\View;

class SecurityController
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
            if ($user->findBy("email",$_POST["email"])) {
                Session::set("errors", ["email" => "This email already exist"]);
                Router::redirectTo("security.register");
            }
            $token = bin2hex(random_bytes(50));
            $user->setEmail($_POST["email"]);
            $user->setFirstname($_POST["firstname"]);
            $user->setLastname($_POST["lastname"]);
            $user->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
            $user->setAccessToken(password_hash($token, PASSWORD_DEFAULT));
            $user->save();
            $user->verify($token);
            Router::redirectTo("security.login");
        } else {
            Router::redirectTo("security.register");
        }
    }

    /**
     * @throws \Exception
     */
    public function verifEmail(): void
    {
        $route = Router::getActualRoute();
        $token = $route->getParam("token");
        $email = $route->getParam("email");
        if (!$token || !$email) {
            Router::redirectTo("errors.404");
        }
        $user = new User();
        $user = $user->findBy("email", $email);
        if(!$user) {
            Router::redirectTo("errors.404");
        }
        $user = User::hydrate($user);
        if($user->isVerified()){
            Router::redirectTo("errors.404");
        }
        if (password_verify($token, $user->getAccessToken())) {
            $user->setVerified(true);
            $user->setAccessToken(null);
            $user->setId($user->getId());
            $user->update();
            Session::set("success", "Votre compte a bien été vérifié");
            Router::redirectTo("security.login");
        } else {
            Router::redirectTo("errors.404");
        }
    }

    public function login(): View
    {
        return new View("Auth/login", "front");
    }

    public function handleLogin(): void
    {
        $loginForm = new LoginForm();

        Session::set("errors", Verificator::form($loginForm->getConfig(), $_POST));
        $errors = Session::get("errors");
        if (empty($errors)) {
            $user = new User();
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            if ($user->login()) {
                Router::redirectTo("home");
            } else {
                Session::set("errors", ["global" => "Email ou mot de passe incorrect"]);
                Router::redirectTo("security.login");
            }
        } else {
            // go back to login page with errors
            Router::redirectTo("security.login");
        }
    }

    public function logout(): void
    {
        echo "Logout";
    }

}