<?php

declare(strict_types=1);

namespace App\Entities;

use DateTimeImmutable;

class Reminder extends AbstractEntity
{
    protected array $fields = ['title', 'when'];

    public function __construct(protected string $title, protected DateTimeImmutable $when)
    {}
}