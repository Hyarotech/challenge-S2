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
                if (method_exists($config['rulesClass'], $rule)) {
                    if (!$config['rulesClass']::$rule($data[$name], [
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

    public static function one(string $field, array $rules ,mixed $data): array {
            $input = [ "inputs" => [
                $field => [
                    "rules"=>$rules,
                ],
            ]];
        return self::form($input, [$field=>$data]);
    }

    public static function throwExceptions(array $listOfErrors): void
    {
        foreach ($listOfErrors as $error) 
            throw new \Exception($error[0]);
    }

}