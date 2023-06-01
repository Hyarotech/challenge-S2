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
                "method" => $this->getMethod()
            ],
            "inputs" => [
                "email" => [
                    "rules" => ["required"],
                    "error" => "Le format de votre email est incorrect"
                ],
                "password" => [
                    "rules" => ["required"],
                    "error" => "Votre mot de passe est incorrect"
                ]
            ]
        ];
    }
}