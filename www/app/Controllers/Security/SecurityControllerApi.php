<?php

namespace App\Controllers\Security;

use App\Models\User;
use App\Notifications\VerifyUserEmailNotification;
use App\Requests\LoginRequest;
use App\Requests\RegisterRequest;
use Core\IControllerApi;
use Core\FlashNotifier;
use Core\ResourceView;
use Core\Router;
use Core\Session;
use Exception;

class SecurityControllerApi
{
    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request): void
    {
        if (User::findBy("email", $request->get("email"))) {
            Session::set("errors", ["email" => "This email already exist"]);
            Router::redirectTo("security.register");
        }
        $token = bin2hex(random_bytes(50));
        $data = [
            "firstname" => $request->get("firstname"),
            "lastname" => $request->get("lastname"),
            "email" => $request->get("email"),
            "password" => password_hash($request->get("password"), PASSWORD_DEFAULT),
            "verif_token" => password_hash($token, PASSWORD_DEFAULT),
        ];
        User::save($data);
        $data["verif_token"] = $token;
        new VerifyUserEmailNotification($data);
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
        if($user->isVerified()) {
            FlashNotifier::error("Your account is already verified");
            Router::redirectTo("errors.404");
        }
        if (password_verify($token, $user->getVerifToken())) {
            $data=[
                "firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname(),
                "email" => $user->getEmail(),
                "verified" => true,
                "verif_token" => null,
            ];
            User::update($user->getId(), $data);
            FlashNotifier::success("Votre compte a bien été vérifié");
            Router::redirectTo("security.login");
        } else {
            FlashNotifier::error("Invalid token or email here");
            Router::redirectTo("errors.404");
        }
    }

    public function login(LoginRequest $request): void
    {
        $user = new User();
        $user->setEmail($request->get("email"));
        $user->setPassword($request->get("password"));
        $userInDb = User::findBy("email", $user->getEmail());
        if (!$userInDb) {
            Session::set("errors", ["global" => "Email ou mot de passe incorrect"]);
            Router::redirectTo("security.login");
        }

        if (!password_verify($user->getPassword(), $userInDb->getPassword())) {
            Session::set("errors", ["global" => "Email ou mot de passe incorrect"]);
            Router::redirectTo("security.login");
        }


        if (!$userInDb->isVerified()) {
            FlashNotifier::error("Your account is not verified");
            Router::redirectTo("security.login");
        }

        $setAccessToken = bin2hex(random_bytes(50));
        $data = [
            "access_token" => $setAccessToken
        ];
        User::update($userInDb->getId(), $data);
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

        $user = User::findBy("email", $userInSession["email"]);
        $data = [
            "access_token" => null
        ];
        User::update($user->getId(), $data);
        Session::set("user", null);
        FlashNotifier::success("Vous êtes déconnecté");
        Router::redirectTo("security.login");
    }

}
