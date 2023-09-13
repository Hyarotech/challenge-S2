<?php
namespace App\Rules;

use App\Configs\PageConfig;
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
    public static function visibility($value, $data, &$listOfErrors): bool
    {   
        if (!in_array((int)$value,PageConfig::VISIBILITY)) {
            $listOfErrors[$data["name"]][] = "La visibilité de votre page doit être publique ou privée.";
            return false;
        }
        return true;
    }
    public static function page_type($value, $data, &$listOfErrors): bool
    {   
        if (!in_array((int)$value,PageConfig::TYPE)) {
            $listOfErrors[$data["name"]][] = "Le type de votre page est invalide";
            return false;
        }
        return true;
    }
}