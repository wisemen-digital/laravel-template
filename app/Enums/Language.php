<?php

namespace App\Enums;

enum Language : string implements IsEnum
{
    use EnumTrait;

    case nl = 'nl';
    case fr = 'fr';
    case en = 'en';
}
