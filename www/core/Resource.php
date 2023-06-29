<?php

namespace Core;

class Resource
{
    private String $view;
    private String $template;
    private $data = [];

    public function __construct(String $view, String $template="back")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }


    public function assign(String $key, $value): void
    {
        $this->data[$key]=$value;
    }

    public function setView(String $view): void
    {
        $view = ROOT."/app/Views/".trim($view).".view.php";
        if(!file_exists($view)) {
            die("La vue ".$view." n'existe pas");
        }
        $this->view = $view;
    }
    public function setTemplate(String $template): void


    {
        $template = ROOT."/app/Views/".trim($template).".tpl.php";
        if(!file_exists($template)) {
            die("Le template ".$template." n'existe pas");
        }
        $this->template = $template;
    }


    public function modal($name, $config): void
    {
        include ROOT."/app/Views/Modals/".$name.".php";
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }

}
