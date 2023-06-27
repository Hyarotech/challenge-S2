<?php

namespace Core;

abstract class Notification
{
    protected array $data = [];
    protected Mail $mail;

    public function __construct()
    {
        $this->mail = new Mail();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    protected function get(string $key): mixed
    {
        return $this->data[$key] ?? null;
    }

    abstract public function execute() :void;


}