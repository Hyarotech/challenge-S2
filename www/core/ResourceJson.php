<?php

namespace Core;

class ResourceJson
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

    public function getJson(): false|string
    {
        return json_encode([
            "success" => $this->success,
            "data" => $this->data,
            "errors" => $this->errors
        ]);
    }

    public function __destruct()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo $this->getJson();
    }

}