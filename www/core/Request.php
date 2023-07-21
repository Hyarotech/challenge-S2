<?php

namespace Core;

class Request
{
    // request object to pass to routeur
    private string $method;
    private string $url;
    private array $data;

    public function __construct()
    {
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->url = $_SERVER["REQUEST_URI"];
        $this->data = $_REQUEST;
        $actualRoute = Router::getActualRoute();
        $params = $actualRoute->getParams();
        if(!empty($params)){
            foreach ($params as $paramName=>$param){
                $this->data[$paramName] = $param;
            }
        }
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
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

    public function get(string $key): string|null
    {
        if (!isset($this->data[$key])) {
            return null;
        }
        return $this->data[$key];
    }

    public function hasId(): bool{
        $data = $this->getData();
        if(!empty($data)){
            if(isset($data["id"])){
                return is_int($data["id"]);
            }
        }
        return false;
    }
}