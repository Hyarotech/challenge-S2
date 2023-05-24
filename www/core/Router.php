<?php

namespace Core;

class Router
{
    private array $routes;
    private array $indexedRoutes;
    public function __construct()
    {
        if(!file_exists(__DIR__."/../routes.yml")) {
            die("Le fichier de routing n'existe pas");
        }
        $this->routes = yaml_parse_file(__DIR__."/../routes.yml");
        $this->indexRoutes();
    }

    public function indexRoutes():void
    {
        foreach($this->routes as $url => $route) {
            $this->indexedRoutes[$route['name']] = $url;
        }
    }

    public function getRoute(string $url):array|bool
    {
        if(!empty($this->routes[$url])) {
            return $this->routes[$url];
        }
        return false;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getController(string $url):string|bool
    {
        if(!empty($this->routes[$url])) {
            return $this->routes[$url]['controller'];
        }
        return false;
    }

    public function getAction(string $url):string|bool
    {
        if(!empty($this->routes[$url])) {
            return $this->routes[$url]['action'];
        }
        return false;
    }

    public function getName(string $url):string|bool
    {
        if(!empty($this->routes[$url])) {
            return $this->routes[$url]['name'];
        }
        return false;
    }

    public function getRouteByName(string $name):array|bool
    {
        if(isset($this->indexedRoutes[$name])) {
            return $this->getRoute($this->indexedRoutes[$name]);
        }
        return false;
    }



}