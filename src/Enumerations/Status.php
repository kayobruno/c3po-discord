<?php

declare(strict_types=1);

namespace App\Enumerations;

enum Status: string
{
    case PENDING = 'pending';
    case NOTIFIED = 'notified';
}
