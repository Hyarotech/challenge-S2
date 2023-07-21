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
    else
        throw new \Exception('Composant "'.$component.'.'.$type.'.php" inexistant');
}

function getJS(){
    $path = strtok($_SERVER['REQUEST_URI'],'?');
    while($path != "/"){
        $scriptName = "/assets/js".$path.".js";
        if(file_exists(ROOT.'/public'.$scriptName))
            return $scriptName;
        $path = dirname($path);            
    }
    return '/assets/js/app.js';
}

function frenchDate(){
    $tz = new DateTimeZone('Europe/Paris');
    $date = new DateTime('now', $tz);

    return $date;
}

/*function formatFrenchDate(string $date) {
    $dateTime = new DateTime($date);

    $formatter = new \IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    $formatter->setPattern('dd MMMM yyyy \'à\' HH\hmm');

    $jour = $formatter->format($dateTime);
    $dateFr = $dateTime->format('d F Y');
    $heure = $dateTime->format('H\hi');

    return $jour .', le '. $dateFr. ' à ' .$heure;
}*/



function realEmpty($value){
    if($value == 0 || $value == false)
        return false;
        
    return empty($value);
}
