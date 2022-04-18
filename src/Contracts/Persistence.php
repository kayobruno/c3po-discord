<?php

declare(strict_types=1);

namespace App\Contracts;

interface Persistence
{
    public function all(): array;
    public function find(int $id): array;
    public function update(int $id, array $params): void;
    public function insert(array $params): void;
    public function delete(int $id): void;
}