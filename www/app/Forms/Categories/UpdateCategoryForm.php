<?php

namespace App\Forms\Categories;

use App\Forms\Abstract\AForm;

class UpdateCategoryForm extends AForm
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
                    "rules" => ["min:2", "max:200"],
                ],
            ]
        ];
    }
}