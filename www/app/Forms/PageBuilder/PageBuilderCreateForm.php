<?php
namespace App\Forms\PageBuilder;

use App\Forms\Abstract\AForm;

class PageBuilderCreateForm extends AForm
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
                "page_id" => [
                    "rules" => ["integer","required"],
                ],
                "state" => [
                    "rules" => ["json","required"],
                ],
                
            ]
        ];
    }
}
