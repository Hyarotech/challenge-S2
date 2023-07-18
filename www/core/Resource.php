<?php

namespace Core;

use DOMDocument;
use DOMElement;
use DOMText;

class Resource
{
    private string $view;
    private string $template;
    private $data = [];

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


    public function modal($name, $config): void
    {
        include ROOT . "/app/Views/Modals/" . $name . ".php";
    }

    public function getVDom():string
    {
        ob_start();
        extract($this->data);
        include $this->view;
        $html = ob_get_clean();
        return json_encode($this->htmlToJson($html));
    }

    public function htmlToJson($html): array
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();
        libxml_use_internal_errors(false);
        $root = $dom->documentElement;
        return $this->elementToJson($root);
    }

    public function elementToJson($element): array
    {
        $obj = array("type" => $element->tagName);
        if ($element->hasAttributes()) {
            $attributes = array();
            foreach ($element->attributes as $attr) {
                $attributes[$attr->name] = $attr->value;
            }
            $obj["attributes"] = $attributes;
        }
        if ($element->hasChildNodes()) {
            $children = array();
            foreach ($element->childNodes as $childNode) {
                if ($childNode instanceof DOMText) {
                    if (trim($childNode->wholeText) !== "") {
                        $children[] = $childNode->wholeText;
                    }
                } else if ($childNode instanceof DOMElement) {
                    $children[] = $this->elementToJson($childNode);
                }
            }
            if (count($children) > 0) {
                $obj["children"] = $children;
            }
        }
        return $obj;
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }

}
