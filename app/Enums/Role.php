<?php

namespace App\Enums;

use App\Traits\IsEnumTrait;

enum Role implements IsEnum
{
    use IsEnumTrait;

    case admin;
    case user;
}
