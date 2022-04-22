<?php

declare(strict_types=1);

namespace App\Entities;

use App\Enumerations\Frequency;
use DateTimeImmutable;

class Reminder extends AbstractEntity
{
    protected array $fields = ['title', 'when', 'frequency'];

    public function __construct(
        protected string $title,
        protected DateTimeImmutable $when,
        protected Frequency $frequency
    )
    {}
}