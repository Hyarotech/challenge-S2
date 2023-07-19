<?php

namespace App\Forms\User;

use App\Forms\Abstract\AForm;

class UpdateUser extends AForm{

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
            ],
            "inputs" => [
                "firstname" => [
                    "rules"=>["required","min:2","max:120"],
                ],
                "lastname" => [
                    "rules"=>["required","min:2","max:120"],
                ],
                "email" => [
                    "rules"=>["required","email"],
                ],
                "password" => [
                    "rules"=>["required","min:8"],
                ],
                "confirm_password" => [
                    "confirm" => "password",
                    "rules"=> ["required"],
                ],
                "policy" => [
                    "rules"=>["required"],
                ],
            ]
        ];
    }
}