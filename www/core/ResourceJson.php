<?php

namespace Core;

class ResourceJson
{
    private $data = [];

    public function __construct()
    {
    }

    public function assign(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function __destruct()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->data);
    }

}