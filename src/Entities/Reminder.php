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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getWhen(): DateTimeImmutable
    {
        return $this->when;
    }

    public function getFrequency(): Frequency
    {
        return $this->frequency;
    }

    public function __serialize(): array
    {
        return [
            'title' => $this->getTitle(),
            'when' => $this->getWhen(),
            'frequency' => $this->getFrequency(),
        ];
    }
}