<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\{Entity, Persistence, Repository};

class ReminderRepository implements Repository
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

    private function formatData(Entity $entity): array
    {
        return [
            'title' => $entity->getTitle(),
            'when' => $entity->getWhen()->format('Y-m-d H:i:s'),
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ];
    }
}