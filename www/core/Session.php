<?php

namespace Core;

class Session
{

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
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

            $error = $_SESSION["errors"][$input];
            if (is_array($error)) {
                $error = $error[0];
            }
            unset($_SESSION["errors"][$input]);
            return $error;
        }
        return "";
    }
}