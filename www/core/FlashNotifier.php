<?php

namespace Core;

class FlashNotifier
{
    public static function error(string $message): void
    {
        
        if (!isset($_SESSION["flash"])) {
            $_SESSION["flash"] = [];
        }
        
        if(!is_array($_SESSION["flash"]))
            $_SESSION["flash"] = [];

        $_SESSION["flash"]["error"] = $message;
    }

    public static function success(string $message): void
    {
        if (!isset($_SESSION["flash"])) {
            $_SESSION["flash"] = [];
        }
        $_SESSION["flash"]["success"] = $message;
    }

    public static function warning(string $message): void
    {
        if (!isset($_SESSION["flash"])) {
            $_SESSION["flash"] = [];
        }
        $_SESSION["flash"]["warning"] = $message;
    }

    public static function info(string $message): void
    {
        if (!isset($_SESSION["flash"])) {
            $_SESSION["flash"] = [];
        }
        $_SESSION["flash"]["info"] = $message;
    }

    public static function get(string $type): string|null
    {

        if (!isset($_SESSION["flash"])) {
            return null;
        }
        if (!isset($_SESSION["flash"][$type])) {
            return null;
        }
        $message = $_SESSION["flash"][$type];
        unset($_SESSION["flash"][$type]);
        return $message;
    }

}
