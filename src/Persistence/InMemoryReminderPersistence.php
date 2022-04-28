<?php

declare(strict_types=1);

namespace App\Persistence;

use App\Contracts\Persistence;

class InMemoryReminderPersistence implements Persistence
{
    private array $reminders = [];
    private int $lastId = 0;

    public function generateId(): int
    {
        $this->lastId++;
        return $this->lastId;
    }

    public function all(): array
    {
        return $this->reminders;
    }

    public function find(int $id): array
    {
        return $this->reminders[$id];
    }

    public function update(int $id, array $params): void
    {
        $this->reminders[$id] = $params;
    }

    public function insert(array $params): void
    {
        $this->reminders[$this->generateId()] = $params;
    }

    public function delete(int $id): void
    {
        unset($this->reminders[$id]);
    }
}