<?php

namespace App\Forms\Security;

use App\Forms\Abstract\AForm;
use Core\Router;

class LoginForm extends AForm
{

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => Router::generateURl("security.login.handle"),
                "enctype" => "",
                "submit" => "Se connecter",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "error" => "Le format de votre email est incorrect"
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "error" => "Votre mot de passe est incorrect"
                ]
            ]
        ];
    }

    public function getRules(): array
    {
        return [
            "email" => [
                "rules" => [
                    "required" => true,
                    "email" => true
                ],
                "message" => "Votre email est requis sous le format xyz@example.com"
            ],
            "password" => [
                "rules" => [
                    "required" => true,
                    "regex" => "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/"
                ],
                "message" => "Votre mot de passe doit contenir au moins 8 caractères: 1 lettre, 1 chiffre et 1 caractère spécial au minimum"
            ]
        ];
    }
}