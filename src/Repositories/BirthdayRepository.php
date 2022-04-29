<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Entity;

class BirthdayRepository extends AbstractRepository
{
    public function formatData(Entity $entity): array
    {
        return [
            'name' => $entity->getName(),
            'when' => $entity->getWhen()->format('Y-m-d H:i:s'),
            'status' => $entity->getStatus()->value,
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ];
    }
}
