<?php

namespace App\Controllers;

use App\Forms\Security\AddUser;
use App\Forms\Security\LoginForm;
use App\Models\User;
use App\Requests\LoginRequest;
use App\Requests\RegisterRequest;
use Core\enums\Role;
use Core\FlashNotifier;
use Core\Request;
use Core\Router;
use Core\Session;
use Core\Verificator;
use Core\Resource;
use Exception;

class SecurityController
{
    public function register(): Resource
    {
        return new Resource("Auth/register", "front");
    }

    /**
     * @throws Exception
     */
    public function handleRegister(RegisterRequest $request): void
    {
        if (User::findBy("email",$request->get("email"))) {
            Session::set("errors", ["email" => "This email already exist"]);
            Router::redirectTo("security.register");
        }
        $token = bin2hex(random_bytes(50));
        $user = new User();
        $user->setEmail($request->get("email"));
        $user->setFirstname($request->get("firstname"));
        $user->setLastname($request->get("lastname"));
        $user->setPassword(password_hash($request->get("password"), PASSWORD_DEFAULT));
        $user->setVerifToken(password_hash($token, PASSWORD_DEFAULT));
        $user->save();
        $user->verifyUserEmail($token);
        Router::redirectTo("security.login");
    }

    /**
     * @throws Exception
     */
    public function verifEmail(): void
    {
        $route = Router::getActualRoute();
        $token = $route->getParam("token");
        $email = $route->getParam("email");
        if (!$token || !$email) {
            FlashNotifier::error("Invalid token or email");
            Router::redirectTo("errors.404");
        }
        $user = User::findBy("email", $email);
        if(!$user) {
            FlashNotifier::error("Invalid user");
            Router::redirectTo("errors.404");
        }

        $user = User::hydrate($user);
        if($user->isVerified()){
            FlashNotifier::error("Your account is already verified");
            Router::redirectTo("errors.404");
        }
        if (password_verify($token, $user->getVerifToken())) {
            $user->setVerified(true);
            $user->setVerifToken(null);
            $user->setId($user->getId());
            $user->update();
            Session::set("success", "Votre compte a bien été vérifié");
            Router::redirectTo("security.login");
        } else {
            FlashNotifier::error("Invalid token or email here");
            Router::redirectTo("errors.404");
        }
    }

    public function login(): Resource
    {
        return new Resource("Auth/login", "front");
    }

    public function handleLogin(LoginRequest $request): void
    {
        $user = new User();
        $user->setEmail($request->get("email"));
        $user->setPassword($request->get("password"));
        $userInDb = User::findBy("email", $user->getEmail());
        if (!$userInDb) {
            Session::set("errors", ["global" => "Email ou mot de passe incorrect"]);
            Router::redirectTo("security.login");
        }
        $userInDb = User::hydrate($userInDb);

        if (!password_verify($user->getPassword(), $userInDb->getPassword())) {
            Session::set("errors", ["global" => "Email ou mot de passe incorrect"]);
            Router::redirectTo("security.login");
        }
        if (!$userInDb->isVerified()) {
            FlashNotifier::error("Your account is not verified");
            Router::redirectTo("security.login");
        }
        $setAccessToken = bin2hex(random_bytes(50));
        $userInDb->setAccessToken($setAccessToken);
        $userInDb->update();
        Session::set("user", [
            "email"=> $userInDb->getEmail(),
            "accessToken" => $setAccessToken,
        ]);
        FlashNotifier::success("Vous êtes connecté");
        Router::redirectTo("home");
    }

    public function logout(): void
    {
        $userInSession = Session::get("user");
        Session::set("user", null);
        $user = User::findBy("email", $userInSession["email"]);
        $user = User::hydrate($user);
        $user->setAccessToken(null);
        $user->update();
        FlashNotifier::success("Vous êtes déconnecté");
        Router::redirectTo("security.login");
    }

}