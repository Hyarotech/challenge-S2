<?php

namespace Core;

class Session
{

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        return $_SESSION[$key];
    }

    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        session_destroy();
    }

    public static function getError(string $input)
    {
        if (!empty($_SESSION["errors"][$input])) {
            return $_SESSION["errors"][$input][0];
        }
        return "";
    }

}