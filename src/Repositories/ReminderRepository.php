<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\{Entity};

class ReminderRepository extends AbstractRepository
{
    public function formatData(Entity $entity): array
    {
        return [
            'title' => $entity->getTitle(),
            'when' => $entity->getWhen()->format('Y-m-d H:i:s'),
            'frequency' => $entity->getFrequency()->value,
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ];
    }
}