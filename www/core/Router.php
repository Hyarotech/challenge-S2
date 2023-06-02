<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{

    public array $routeRouter = [];


    #[NoReturn] public function redirectTo(string $routeName): void
    {
        $url = $this->getRouteByName($routeName);
        if (!$url) {
            die("La route " . $routeName . " n'existe pas");
        }
        header("Location: " . $url->getPath());
        exit;
    }

    public function getRoute(string $url, string $method = "GET"): Route|bool
    {
        $routes = array_filter($this->routeRouter, function (Route $route) use ($method, $url) {
            return $route->getPath() === $url && $route->getMethod() === $method;
        });
        if (!empty($routes)) {
            return $routes[array_key_first($routes)];
        }
        return false;
    }

    public function getRouteByName(string $name)
    {
        $routes = array_filter($this->routeRouter, function (Route $route) use ($name) {
            return $route->getName() === $name;
        });
        if (!empty($routes)) {
            return $routes[array_key_first($routes)];
        }
        return false;
    }

    //TODO replace usage by $router->getRouteByName($name)->getPath()

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
        $this->routeRouter[] = $route;
        return $route;
    }

    public function post(string $path, array $callable): Route
    {
        $route = new Route();
        $route->setPath($path);
        $route->setController($callable[0]);
        $route->setAction($callable[1]);
        $route->setMethod("POST");
        $this->routeRouter[] = $route;
        return $route;
    }


}