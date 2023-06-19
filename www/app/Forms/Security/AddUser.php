<?php

namespace App\Forms\Security;

use App\Forms\Abstract\AForm;

class AddUser extends AForm
{

    protected string $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
            ],
            "inputs" => [
                "firstname" => [
                    "rules"=>["required","min:2","max:120"],
                    "error" => "Votre prénom doit faire entre 2 et 120 caractères"
                ],
                "lastname" => [
                    "rules"=>["required","min:2","max:120"],
                    "error" => "Votre nom doit faire entre 2 et 120 caractères"
                ],
                "email" => [
                    "rules"=>["required","email"],
                    "error" => "Le format de votre email est incorrect"
                ],
                "password" => [
                    "rules"=>["required","min:8","regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"],
                    "error" => "Votre mot de passe est incorrect"
                ],
                "confirm_password" => [
                    "confirm" => "password",
                    "rules"=> ["required"],
                    "error" => "Mot de passe de confirmation incorrect"
                ],
                "policy" => [
                    "rules"=>["required"],
                    "error" => "Vous devez accepter les conditions d'utilisation"
                ],
            ]
        ];
    }
}