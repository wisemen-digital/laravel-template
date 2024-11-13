<?php

namespace App\Enums;

use App\Enums\Traits\IsExtendedEnum;

enum Language: string implements IsEnum
{
    use IsExtendedEnum;

    case nl = 'nl';
    case fr = 'fr';
    case en = 'en';
}
