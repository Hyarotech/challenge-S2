<?php
namespace App\Forms\Setting;

use App\Forms\Abstract\AForm;

class MenuSaveForm extends AForm
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
                "menu_data" => [
                    "rules" => ["required","json"]
                ]
            ]
        ];
    }
}
