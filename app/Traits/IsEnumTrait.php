<?php

namespace App\Traits;

trait IsEnumTrait
{
    public static function all(): array
    {
        return array_column(self::cases(), 'name');
    }
}
