<?php

namespace Core;

use App\Configs\PageConfig;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\AuthMiddleware;
use App\Models\Category;
use App\Models\CatPage;
use App\Models\Page;

class SitemapGenerator
{
    private array $routes = [];

    public function __construct(private readonly Router $router, private readonly string $baseURL)
    {
        $routes = $this->router->getRoutes();
        foreach ($routes as $route) {
            $middlewares = $route->getMiddlewares();
            $path = $route->getPath();
            if ($route->getMethod() === 'GET'
                && !str_contains($path, ":")
                && !str_contains($path, "install")
                && !in_array(AuthMiddleware::class, $middlewares)
                && !in_array(AdminMiddleware::class, $middlewares)) {
                $this->routes[] = $route->getPath();
            }
        }
        $pages = Page::findAllBy("visibility", PageConfig::VISIBILITY["public"]);
        foreach ($pages as $page) {
            $this->routes[] = "/page/" . $page->getSlug();
        }

        $categories = Category::findAll();
        $catPages = CatPage::findAll();
        foreach ($categories as $category) {
            //check if categoryId is in catPage
            foreach ($catPages as $catPage) {
                if ($catPage->getCategoryId() === $category->getId()) {
                    $this->routes[] = "/blog/" . $category->getName();
                }
            }
        }

    }

    public function generateSitemap(): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($this->routes as $route) {
            $xml .= '<url>' . PHP_EOL;
            $xml .= '<loc>' . $this->baseURL . $route . '</loc>' . PHP_EOL;

            // Add other optional elements like last modification date and change frequency here if needed

            $xml .= '</url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return $xml;
    }

    public function generateRobots(): string
    {
        $xml = 'User-agent: *' . PHP_EOL;
        $xml .= 'Allow: /' . PHP_EOL;
        $xml .= 'Sitemap: ' . $this->baseURL . '/sitemap.xml' . PHP_EOL;
        return $xml;
    }

    //create sitemap.xml
    public function createSitemap(): void
    {
        //check if a file exists and if it's older than 24h
        $file = ROOT . "/public/sitemap.xml";
        if (file_exists($file) && filemtime($file) > (time() - 24 * 60 * 60)) {
            return;
        }
        $sitemap = $this->generateSitemap();
        $file = fopen($file, "w");
        fwrite($file, $sitemap);
        fclose($file);
    }

    //create robots.txt
    public function createRobots(): void
    {
        //check if a file exists and if it's older than 24h
        $file = ROOT . "/public/robots.txt";
        if (file_exists($file) && filemtime($file) > (time() - 24 * 60 * 60)) {
            return;
        }
        $robots = $this->generateRobots();
        $file = fopen($file, "w");
        fwrite($file, $robots);
        fclose($file);
    }

    //create sitemap.xml and robots.txt
    public function createSitemapAndRobots(): void
    {
        $this->createSitemap();
        $this->createRobots();
    }

    public function __destruct()
    {
        $this->createSitemapAndRobots();
    }
}