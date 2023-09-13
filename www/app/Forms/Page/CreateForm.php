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
                    "rules" => ["required", "min:2", "max:200"],
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
                "is_comment_enabled" => [
                    "rules" => ["required","boolean"],
                ],
                "visibility" => [
                    "rules" => ["required", "integer","visibility"],
                ],
                "page_type" => [
                    "rules" => ["required", "integer","page_type"],
                ],
                "user_id" => [
                    "rules" => ["required", "integer"],
                ],
            ]
        ];
    }
}
