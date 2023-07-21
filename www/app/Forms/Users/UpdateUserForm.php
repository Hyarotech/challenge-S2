<?php

namespace App\Forms\Users;

class UpdateUserForm extends \App\Forms\Abstract\AForm
{

    protected string $method = "POST";

    public function getConfig(): array
    {
        return [
            "rulesClass" => "Core\Rules",
            "config" => [
                "method" => $this->getMethod()
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
                ]
            ]
        ];
    }
}