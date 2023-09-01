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
                    "rules" => ["required", "min:2", "max:200", "title"],
                ],
                "description" => [
                    "rules" => ["required", "max:200"],
                ],
                "slug" => [
                    "rules" => ["required", "min:2", "max:200", "slug"],
                ],
                "is_no_follow" => [
                    "rules" => ["required","boolean"],
                ],
                "visibility" => [
                    "rules" => ["required", "integer","visibility"],
                ],
                "user_id" => [
                    "rules" => ["required", "integer"],
                ],
            ]
        ];
    }
}
