<?php

namespace Core;

class Rules
{

    public static function required($value,$data,&$listOfErrors): bool
    {
        if(empty($value)){
            $listOfErrors[$data["name"]][] = "Le champ " . $data["name"]." est requis";
            return false;
        }
        return true;
    }

    public static function min($value,$data,&$listOfErrors): bool
    {
        if(strlen($value) < $data["args"][0]){
            $listOfErrors[$data["name"]][] = "Le champ " . $data["name"]." doit faire au moins ".$data["args"][0]." caractères";
            return false;
        }
        return true;
    }

    public static function max($value,$data,&$listOfErrors): bool
    {
        if(strlen($value) > $data["args"][0]){
            $listOfErrors[$data["name"]][] = "Le champ " . $data["name"]." doit faire au maximum ".$data["args"][0]." caractères";
            return false;
        }
        return true;
    }

    public static function email($value,$data,&$listOfErrors): bool
    {
        if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
            $listOfErrors[$data["name"]][] = "Le champ " . $data["name"]." doit être un email valide";
            return false;
        }
        return true;
    }

    public static function regex($value,$data,&$listOfErrors): bool
    {
        if(!preg_match($data["args"][0],$value)){
            $listOfErrors[$data["name"]][] = "Le champ " . $data["name"]." ne répond pas aux règles de validation";
            return false;
        }
        return true;
    }
}