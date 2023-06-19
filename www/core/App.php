<?php

namespace Core;

class App
{
    public function __construct(
        private Router $router,
        private string $envFile = ".env"
    )
    {
        // parse .env file
        $_ENV = parse_ini_file($this->envFile);
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @return string
     */
    public function getEnvFile(): string
    {
        return $this->envFile;
    }

    /**
     * @param Router $router
     * @return App
     */
    public function setRouter(Router $router): App
    {
        $this->router = $router;
        return $this;
    }

    /**
     * @param string $envFile
     * @return App
     */
    public function setEnvFile(string $envFile): App
    {
        $this->envFile = $envFile;
        return $this;
    }
}