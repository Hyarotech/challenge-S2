<?php

namespace App\Forms\Security;

class PasswordForgot extends \App\Forms\Abstract\AForm
{
    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
            ],
            "inputs" => [
                "token" => [
                    "rules" => ["required"],
                ],
                "password" => [
                    "rules"=>["required","min:8"],
                ],
                "confirm_password" => [
                    "confirm" => "password",
                    "rules"=> ["required"],
                ],
            ]
        ];
    }
}
