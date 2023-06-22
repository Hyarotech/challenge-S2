<?php

namespace Core;


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

    public static function getActualRoute(): ?Route
    {
        $router = self::getInstance();
        require ROOT . "/routes/web.php";
        return $router->resolveRoute();

    }

    public static function generateRoute(string $name): bool|string
    {
        $router = self::getInstance();
        require ROOT . "/routes/web.php";
        return $router->generateURL($name);
    }

    public static function generateDynamicRoute(string $name, array $params): bool|string
    {
        $router = self::getInstance();
        require ROOT . "/routes/web.php";
        return $router->generateURL($name, $params);
    }


    public static function redirectTo(string $routeName): void
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

    public function generateURL(string $name, ?array $params = null): string|bool
    {
        $route = $this->getRouteByName($name);
        if (!$route) {
            return "";
        }
        if (is_null($params)) {
            return $route->getPath();
        }
        $url = $route->getPath();
        foreach ($params as $key => $value) {
            $url = str_replace(":$key", $value, $url);
        }
        return $url;
    }

    public function resolveRoute() :Route|null
    {
        $uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
        $uri = rtrim(strtolower(trim($uriExploded[0])), "/");
        $uri = (empty($uri)) ? "/" : $uri;
        $method = $_SERVER["REQUEST_METHOD"];
        //Dans le cas ou nous sommes à la racine $uri sera vide du coup je remets /
        $uri = (empty($uri)) ? "/" : $uri;
        $route = $this->getRoute($uri, $method);
        if (!$route) {
            //check for dynamic routes with :id for example

            $route = $this->getRouteByDynamicURL($uri, $method);
            if (!$route) {
                return null;
            }
        }
        return $route;
    }
    public function run(): void
    {

        $route = $this->resolveRoute();
        if(!$route){
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

    private function getRouteByDynamicURL($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route->getMethod() !== $method) {
                continue;
            }

            $pattern = preg_replace_callback('#:(\w+)#', function ($matches) {
                return '(?<' . $matches[1] . '>[^/]+)';
            }, $route->getPath());
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $uri, $matches)) {
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                $route->setParams($params);
                return $route;
            }
        }

        return null;
    }


}