<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{

    private array $routes = [];
    private static ?Router $instance = null;


    public static function getInstance(): ?Router
    {
        if (is_null(self::$instance)) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    public static function generateRoute(string $name): bool|string
    {
        $router = self::getInstance();
        require ROOT . "/routes/web.php";
        return $router->generateURL($name);
    }


    #[NoReturn] public static function redirectTo(string $routeName): void
    {
        $url = self::generateRoute($routeName);
        if (!$url) {
            die("La route " . $routeName . " n'existe pas");
        }
        header("Location: " . $url);
        exit;
    }

    public function getRoute(string $url, string $method = "GET"): Route|bool
    {
        $routes = array_filter($this->routes, function (Route $route) use ($method, $url) {
            return $route->getPath() === $url && $route->getMethod() === $method;
        });
        if (!empty($routes)) {
            return $routes[array_key_first($routes)];
        }
        return false;
    }

    public function getRouteByName(string $name)
    {
        $routes = array_filter($this->routes, function (Route $route) use ($name) {
            return $route->getName() === $name;
        });
        if (!empty($routes)) {
            return $routes[array_key_first($routes)];
        }
        return false;
    }

    public function generateURL(string $name): string|bool
    {
        $route = $this->getRouteByName($name);
        if (!$route) {
            return "";
        }
        return $route->getPath();
    }

    public function run(): void
    {

        $uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
        $uri = rtrim(strtolower(trim($uriExploded[0])), "/");
        $uri = (empty($uri)) ? "/" : $uri;
        $method = $_SERVER["REQUEST_METHOD"];
        //Dans le cas ou nous sommes à la racine $uri sera vide du coup je remets /
        $uri = (empty($uri)) ? "/" : $uri;
        $route = $this->getRoute($uri, $method);
        if (!$route) {
            $this->redirectTo("errors.404");
        }
        $controller = $route->getController();
        $action = $route->getAction();
        $objet = new $controller();
        $objet->$action();
    }

    public function get(string $path, array $callable): Route
    {
        $route = new Route();
        $route->setPath($path);
        $route->setController($callable[0]);
        $route->setAction($callable[1]);
        $route->setMethod("GET");
        $this->routes[] = $route;
        return $route;
    }

    public function post(string $path, array $callable): Route
    {
        $route = new Route();
        $route->setPath($path);
        $route->setController($callable[0]);
        $route->setAction($callable[1]);
        $route->setMethod("POST");
        $this->routes[] = $route;
        return $route;
    }


}