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
                    "rules"=>["min:2","max:120"],
                ],
                "lastname" => [
                    "rules"=>["min:2","max:120"],
                ],
                "email" => [
                    "rules"=>["email"],
                ],
                "verified" => [
                    "rules"=>["boolean"],
                ],
                "role"=>[
                    "rules"=>["string"]
                ]
            ]
        ];
    }
}