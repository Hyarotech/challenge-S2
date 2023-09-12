<?php

namespace Core;

use App\Middlewares\AdminMiddleware;

class SitemapGenerator
{
    private array $routes = [];

    public function __construct(Router $router, string $baseURL)
    {
        $routes = $router->getRoutes();
        foreach ($routes as $route) {
            $middlewares = $route->getMiddlewares();
            $path = $route->getPath();
            if ($route['method'] === 'GET'
                && !str_contains($path, ":")
                && !in_array(AdminMiddleware::class, $middlewares)) {
                $this->routes[] = $route;
            }
        }
    }

    public function generateSitemap(): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($this->routes as $route) {
            $xml .= '<url>' . PHP_EOL;
            $xml .= '<loc>' . $this->baseURL . $route['path'] . '</loc>' . PHP_EOL;

            // Add other optional elements like last modification date and change frequency here if needed

            $xml .= '</url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return $xml;
    }
}