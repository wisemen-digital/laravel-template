<?php

namespace App\Enums;

trait EnumTrait
{
    public static function all(): array
    {
        return array_column(self::cases(), 'name');
    }
}
