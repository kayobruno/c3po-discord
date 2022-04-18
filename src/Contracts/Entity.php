<?php

declare(strict_types=1);

namespace App\Contracts;

interface Entity
{
    public function getTableName(): string;
}