<?php

declare(strict_types=1);

namespace App\Entities;

use App\Enumerations\Status;
use DateTimeImmutable;

class Birthday extends AbstractEntity
{
    protected array $fields = ['name', 'when', 'status'];

    public function __construct(
        protected string $name,
        protected DateTimeImmutable $when,
        protected Status $status = Status::PENDING
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getWhen(): DateTimeImmutable
    {
        return $this->when;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}