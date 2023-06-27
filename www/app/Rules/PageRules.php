<?php
namespace App\Rules;

use Core\Rules;

class PageRules extends Rules {

    public static function title($value, $data, &$listOfErrors): bool
    {
        if (!preg_match('/^[a-zA-Z0-9\-\_\(\) ]+$/', $value)) {
            $listOfErrors[$data["name"]][] = "Le titre ne doit contenir que des lettres, des chiffres, des espaces, tirets ou underscore.";
            return false;
        }
        return true;
    }

    public static function slug($value, $data, &$listOfErrors): bool
    {
        if (!preg_match('/^[a-zA-Z0-9\-\_]+$/', $value)) {
            $listOfErrors[$data["name"]][] = "Le slug ne doit contenir que des lettres, des chiffres, tirets ou underscore.";
            return false;
        }
        return true;
    }

}