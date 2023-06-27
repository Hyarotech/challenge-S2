<?php
namespace App\Forms\Page;

use App\Forms\Abstract\AForm;

class CreateForm extends AForm
{
    protected string $method = "POST";

    public function getConfig(): array
    {
        return [
            "rulesClass" => "App\Rules\PageRules",
            "config" => [
                "method" => $this->getMethod()
            ],
            "inputs" => [
                "title" => [
                    "rules" => ["required", "min:2", "max:60", "title"],
                ],
                "description" => [
                    "rules" => ["required", "max:200"],
                ],
                "slug" => [
                    "rules" => ["required", "min:2", "max:60", "slug"],
                ],
                "isNoFollow" => [
                    "rules" => ["required", "boolean"],
                ],
                "visibility" => [
                    "rules" => ["required", "integer"],
                ],
                "user_id" => [
                    "rules" => ["required", "integer"],
                ],
            ]
        ];
    }
}
