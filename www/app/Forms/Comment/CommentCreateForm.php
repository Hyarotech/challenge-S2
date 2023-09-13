<?php
namespace App\Forms\Comment;

use App\Forms\Abstract\AForm;

class CommentCreateForm extends AForm
{
    protected string $method = "POST";

    public function getConfig(): array
    {
        return [
            "rulesClass" => "\Core\Rules",
            "config" => [
                "method" => $this->getMethod()
            ],
            "inputs" => [
                "page_id" => [
                    "rules" => ["required", "integer"],
                ],
                "message" => [
                    "rules" => ["required", "min:2", "max:120"],
                ]
            ]
        ];
    }
}
