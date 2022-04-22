<?php

declare(strict_types=1);

namespace App\Enumerations;

enum Frequency: string
{
    case ONCE = 'once';
    case REPEAT = 'repeat';
}
