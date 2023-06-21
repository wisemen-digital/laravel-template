<?php

namespace App\Enums;

enum Language implements IsEnum
{
    use EnumTrait;

    case nl;
    case fr;
    case en;
}
