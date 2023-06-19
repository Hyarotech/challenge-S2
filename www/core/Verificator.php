<?php

namespace Core;

use Core\Rules;

class Verificator
{

    public static function form(array $config, array $data): array
    {

        $listOfErrors = [];

        foreach ($config["inputs"] as $name => $input) {
            if (str_starts_with($name, "confirm")) {
                $toConfirm = explode("_", $name)[1];
                if ($data[$name] != $data[$toConfirm]) {
                    $listOfErrors[] = $input["error"];
                }
            }
            foreach ($input["rules"] as $rule) {
                $args = explode(":", $rule);
                $rule = array_shift($args);
                if (method_exists(Rules::class, $rule)) {
                    if (!Rules::$rule($data[$name], [
                        "name" => $name,
                        "args"=>$args
                    ], $listOfErrors)) {
                        break;
                    }
                } else {
                    die("Tentative de Hack: Règle inconnue");
                }
            }

        }
        return $listOfErrors;
    }

}