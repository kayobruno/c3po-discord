<?php

declare(strict_types=1);

namespace Tests\Repositories;

use App\Contracts\Entity;
use App\Contracts\Repository;
use App\Entities\Birthday;
use App\Persistence\InMemoryReminderPersistence;
use App\Repositories\BirthdayRepository;
use DateTimeImmutable;

class BirthdayRepositoryTest extends AbstractRepositoryTest
{
    public function getRepository(): Repository
    {
        $persistence = new InMemoryReminderPersistence();
        return new BirthdayRepository($persistence);
    }

    public function getEntity(): \Generator
    {
        $when = new DateTimeImmutable('1992-12-17');
        $birthday = new Birthday('Kayo', $when);

        yield 'Valid Birthday' => [$birthday];
    }

    public function getUpdatedEntity(): Entity
    {
        $when = new DateTimeImmutable('1992-12-17');
        return new Birthday('Kayo Bruno', $when);
    }
}
