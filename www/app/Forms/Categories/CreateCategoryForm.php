<?php

namespace App\Forms\Categories;

use App\Forms\Abstract\AForm;

class CreateCategoryForm extends AForm
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
                "name" => [
                    "rules" => ["required", "min:2", "max:200"],
                ],
            ]
        ];
    }
}