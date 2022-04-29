<?php

declare(strict_types=1);

namespace Tests\Repositories;

use App\Contracts\{Entity, Repository};
use App\Entities\Reminder;
use App\Enumerations\Frequency;
use App\Persistence\InMemoryReminderPersistence;
use App\Repositories\ReminderRepository;

class ReminderRepositoryTest extends AbstractRepositoryTest
{
    public function getRepository(): Repository
    {
        $persistence = new InMemoryReminderPersistence();
        return new ReminderRepository($persistence);
    }

    public function getEntity(): \Generator
    {
        $reminder = new Reminder('Remind me Foo', new \DateTimeImmutable(), Frequency::ONCE);

        yield 'Valid Birthday' => [$reminder];
    }

    public function getUpdatedEntity(): Entity
    {
        return new Reminder('Remind me Bar', new \DateTimeImmutable(), Frequency::ONCE);
    }
}
