<?php

namespace Core;

class Route
{
    private string $name;
    private string $path;
    private string $controller;
    private string $action;

    private array $params = [];

    private string $method = 'GET';

    private array $middlewares = [];

    private array $body = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Route
     */
    public function setName(string $name): Route
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function getParam(string $identifier): string|null
    {
        if (!isset($this->params[$identifier])) {
            return null;
        }
        return $this->params[$identifier];
    }

    /**
     * @param string $path
     * @return Route
     */
    public function setPath(string $path): Route
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     * @return Route
     */
    public function setController(string $controller): Route
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return Route
     */
    public function setAction(string $action): Route
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return Route
     */
    public function setParams(array $params): Route
    {
        $paramsDecoded = [];
        foreach ($params as $key => $value) {
            $paramsDecoded[$key] = urldecode($value);
        }
        $this->params = $paramsDecoded;
        return $this;
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
     * @return Route
     */
    public function setMethod(string $method): Route
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * @param array $middlewares
     */
    public function setMiddlewares(array $middlewares): Route
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array|null $body
     * @return Route
     */
    public function setBody(?array $body): self
    {
        if($body === null) {
            $body = [];
        }
        $this->body = $body;
        return $this;
    }

}
