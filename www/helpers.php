<?php

function env(string $key, mixed $default = null): mixed
{
    return $_ENV[$key] ?? $default;
}

function toCamelCase($string): string
{
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9]+/i', ' ', $string);
    $string = ucwords(trim($string));
    $string = str_replace(" ", "", $string);
    $string[0] = strtolower($string[0]);
    return $string;
}

function isDateTime($string): bool
{
    return (bool) strtotime($string);
}

function component(string $component, array $data = [], string $type = "view"): void
{
    if(count($data) > 0) {
        extract($data);
    }

    $file = ROOT."/app/Views/".$component.".".$type.".php";
    if(is_file($file)) {
        include $file;
    } else {
        throw new \Exception('Composant "'.$component.'.'.$type.'.php" inexistant');
    }
}
