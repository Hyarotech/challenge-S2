<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    private array $routes;
    private array $indexedRoutes;

    public function __construct()
    {
        if (!file_exists(__DIR__ . "/../routes.yml")) {
            die("Le fichier de routing n'existe pas");
        }
        $this->routes = yaml_parse_file(__DIR__ . "/../routes.yml");
        $this->indexRoutes();
    }

    public function indexRoutes(): void
    {
        foreach ($this->routes as $url => $route) {
            $this->indexedRoutes[$route['name']] = $url;
        }
    }

    public function getRoute(string $url): array|bool
    {
        if (!empty($this->routes[$url])) {
            return $this->routes[$url];
        }
        return false;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getController(string $url): string|bool
    {
        if (!empty($this->routes[$url])) {
            return $this->routes[$url]['controller'];
        }
        return false;
    }

    public function getAction(string $url): string|bool
    {
        if (!empty($this->routes[$url])) {
            return $this->routes[$url]['action'];
        }
        return false;
    }

    public function getName(string $url): string|bool
    {
        if (!empty($this->routes[$url])) {
            return $this->routes[$url]['name'];
        }
        return false;
    }

    public function getRouteByName(string $name): array|bool
    {
        if (isset($this->indexedRoutes[$name])) {
            return $this->getRoute($this->indexedRoutes[$name]);
        }
        return false;
    }

    public function getUrlByName(string $name)
    {
        if (isset($this->indexedRoutes[$name])) {
            return $this->indexedRoutes[$name];
        }
        return false;
    }

    public static function generateURl(string $name): string|bool
    {
        $route = (new self())->getUrlByName($name);
        if (!$route) {
            return false;
        }
        return $route;
    }


    public function __invoke()
    {
        $uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
        $uri = rtrim(strtolower(trim($uriExploded[0])), "/");
        $uri = (empty($uri)) ? "/" : $uri;

// Check if the requested URI is for an asset file
        $extension = pathinfo($uri, PATHINFO_EXTENSION);
        $allowedExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif'];
        if (in_array($extension, $allowedExtensions)) {
            // Serve the asset file directly
            $filePath = __DIR__ . '/public/assets' . $uri; // Assuming the assets are located in the 'public' directory
            if (file_exists($filePath)) {
                header("Content-Type: " . mime_content_type($filePath));
                readfile($filePath);
                exit;
            } else {
                die("Asset not found");
            }
        }
//Dans le cas ou nous sommes à la racine $uri sera vide du coup je remets /
        $uri = (empty($uri)) ? "/" : $uri;
        $route = $this->getRoute($uri);
        if (!$route) {
            die("Page 404");
        }
        $controller = "\\App\\Controllers\\" . $route['controller'];
        if (!class_exists($controller)) {
            die("La class " . $controller . " n'existe pas");
        }
        $action = $route['action'];
        $objet = new $controller();
        if (!method_exists($objet, $action)) {
            die("L'action " . $action . " n'existe pas");
        }
        $objet->$action();
    }


}