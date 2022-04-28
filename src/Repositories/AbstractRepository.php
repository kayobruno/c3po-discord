<?php

namespace App\Repositories;

use App\Contracts\{Entity, Persistence, Repository};

abstract class AbstractRepository implements Repository
{
    public function __construct(private Persistence $persistence)
    {}

    public function all(): array
    {
        return $this->persistence->all();
    }

    public function find(int $id): array
    {
        return $this->persistence->find($id);
    }

    public function save(Entity $entity): void
    {
        $data = $this->formatData($entity);
        $this->persistence->insert($data);
    }

    public function update(int $id, Entity $entity): void
    {
        $data = $this->formatData($entity);
        $this->persistence->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->persistence->delete($id);
    }

    abstract public function formatData(Entity $entity): array;
}