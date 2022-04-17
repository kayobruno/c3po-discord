<?php

declare(strict_types=1);

namespace App\Contracts;

interface Database
{
    public function connect(): void;
}