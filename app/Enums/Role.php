<?php

namespace App\Enums;

enum Role implements IsEnum
{
    case admin;
    case user;

    public static function all(): array
    {
        return array_column(self::cases(), 'name');
    }
}
