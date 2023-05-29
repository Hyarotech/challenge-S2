<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    private array $routes;
    private array $indexedByNameRoutes;

    public function __construct()
    {
        if (!file_exists(__DIR__ . "/../routes.yml")) {
            die("Le fichier de routing n'existe pas");
        }
        $this->setRoutes();
    }

    public function setRoutes(): void
    {
        $data = yaml_parse_file(__DIR__ . "/../routes.yml");
        foreach ($data as $url => $route) {
            $this->routes[$url] = $route;
            $this->indexedByNameRoutes[$route['name']] = $url;
        }
    }

    public function getRoute(string $url): array|bool
    {
        if (!empty($this->routes[$url])) {
            return $this->routes[$url];
        }
        return false;
    }

    public function getRoutes(): array
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
        if (isset($this->indexedByNameRoutes[$name])) {
            return $this->getRoute($this->indexedByNameRoutes[$name]);
        }
        return false;
    }

    public function getUrlByName(string $name)
    {
        if (isset($this->indexedByNameRoutes[$name])) {
            return $this->indexedByNameRoutes[$name];
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
        $method = $_SERVER["REQUEST_METHOD"];

        // Check if the requested URI is for an asset file
        $extension = pathinfo($uri, PATHINFO_EXTENSION);
        $allowedExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif','svg'];
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
        if (!$route || $route['method'] !== $method) {
            die("Page 404");
        }
        $controller = "\\App\\Controllers\\" . $route['controller'];
        if (!class_exists($controller)) {
            die("La classe " . $controller . " n'existe pas");
        }
        $action = $route['action'];
        $objet = new $controller();
        if (!method_exists($objet, $action)) {
            die("L'action " . $action . " n'existe pas");
        }
        $objet->$action();
    }


}