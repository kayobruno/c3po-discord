<?php

declare(strict_types=1);

namespace App\Contracts;

interface Repository
{
    public function all(): array;
    public function find(int $id): array;
    public function save(Entity $entity): void;
    public function update(int $id, Entity $entity): void;
    public function delete(int $id): void;
}