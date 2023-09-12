<?php

namespace Core;

use ReflectionException;

class App
{
    public function __construct(
        private Router $router
    )
    {
        if(file_exists(ROOT."/.env")){
            $_ENV = parse_ini_file(ROOT."/.env");
        }
        try {
            $this->router->run();
        } catch (\Exception $e) {
        }
    }

    public function __destruct()
    {
        Session::clearCsrf();
    }
}
