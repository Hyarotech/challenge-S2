<?php

namespace Core;

use DOMDocument;
use DOMElement;
use DOMText;

class ResourceView
{
    private string $view;
    private string $template;
    private array $data = [];

    public function __construct(string $view, string $template = "back")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }


    public function assign(string $key, $value): void
    {
        $this->data[$key] = $value;
    }


    public function setView(string $view): void
    {
        $view = ROOT . "/app/Views/" . trim($view) . ".view.php";
        if (!file_exists($view)) {
            die("La vue " . $view . " n'existe pas");
        }
        $this->view = $view;
    }

    public function setTemplate(string $template): void
    {
        $template = ROOT . "/app/Views/" . trim($template) . ".tpl.php";
        if (!file_exists($template)) {
            die("Le template " . $template . " n'existe pas");
        }
        $this->template = $template;
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }

}