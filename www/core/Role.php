<?php

namespace Core;

enum Role
{
    const USER = 0;
    const ADMIN = 1;

    public static function getRoleName($role): string
    {
        return match ($role) {
            self::ADMIN => 'Admin',
            self::USER => 'User',
            default => 'Unknown',
        };
    }

    public static function getRoles(): array
    {
        return [
            self::ADMIN,
            self::USER,
        ];
    }
}