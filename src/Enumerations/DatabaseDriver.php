<?php

declare(strict_types=1);

namespace App\Enumerations;

enum DatabaseDriver:string
{
    case MYSQL = 'mysql';
    case PGSQL = 'pgsql';
    case SQLITE = 'sqlite';
}