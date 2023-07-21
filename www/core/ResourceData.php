<?php

namespace Core;

class ResourceData
{
    private array $data = [];
    private array $errors = [];

    private bool $success = false;

    public function __construct()
    {
        $this->success = true;
    }

    public function assign(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function addError(string $key, string $value): void
    {
        $this->success = false;
        $this->errors[$key] = $value;
    }

    public function getData(): array
    {
        return [
            "success" => $this->success,
            "data" => $this->data,
            "errors" => $this->errors
        ];
    }
    


}
