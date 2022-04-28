<?php

declare(strict_types=1);

namespace Tests\Repositories;

use App\Contracts\Persistence;
use App\Entities\Reminder;
use App\Enumerations\Frequency;
use App\Persistence\InMemoryReminderPersistence;
use App\Repositories\ReminderRepository;
use PHPUnit\Framework\TestCase;

class ReminderRepositoryTest extends TestCase
{
    private Persistence $persistence;
    private ReminderRepository $reminderRepository;

    public function setUp(): void
    {
        $this->persistence = new InMemoryReminderPersistence();
        $this->reminderRepository = new ReminderRepository($this->persistence);
    }

    /**
     * @test
     */
    public function reminderRepository_ShouldSaveEntityInMemory(): void
    {
        $reminder = new Reminder('Remind me Foo', new \DateTimeImmutable(), Frequency::ONCE);
        $this->reminderRepository->save($reminder);

        $expectedEntityTotal = 1;
        $this->assertCount($expectedEntityTotal, $this->reminderRepository->all());
    }

    /**
     * @test
     */
    public function reminderRepository_ShouldGetAllEntitiesInMemory(): void
    {
        $reminder = new Reminder('Remind me Foo', new \DateTimeImmutable(), Frequency::ONCE);
        $this->reminderRepository->save($reminder);
        $this->reminderRepository->save($reminder);
        $this->reminderRepository->save($reminder);

        $expectedEntitiesTotal = 3;
        $this->assertCount($expectedEntitiesTotal, $this->reminderRepository->all());
    }

    /**
     * @test
     */
    public function reminderRepository_ShouldFindEntityById(): void
    {
        $reminderOne = new Reminder('Remind me Foo', new \DateTimeImmutable(), Frequency::ONCE);
        $reminderTwo = new Reminder('Remind me Bar', new \DateTimeImmutable(), Frequency::REPEAT);

        $this->reminderRepository->save($reminderOne);
        $this->reminderRepository->save($reminderTwo);

        $reminder = $this->reminderRepository->find(1);

        $this->assertEquals($reminderOne->getTitle(), $reminder['title']);
        $this->assertEquals($reminderOne->getWhen()->format('Y-m-d H:i:s'), $reminder['when']);
        $this->assertEquals($reminderOne->getFrequency()->value, $reminder['frequency']);
    }

    /**
     * @test
     */
    public function reminderRepository_ShouldUpdateEntity(): void
    {
        $reminder = new Reminder('Remind me Foo', new \DateTimeImmutable(), Frequency::ONCE);
        $this->reminderRepository->save($reminder);

        $reminderUpdate = new Reminder('Remind me Bar', new \DateTimeImmutable(), Frequency::ONCE);
        $this->reminderRepository->update(1, $reminderUpdate);

        $data = $this->reminderRepository->find(1);

        $this->assertEquals($reminderUpdate->getTitle(), $data['title']);
        $this->assertEquals($reminderUpdate->getWhen()->format('Y-m-d H:i:s'), $data['when']);
        $this->assertEquals($reminderUpdate->getFrequency()->value, $data['frequency']);
    }

    /**
     * @test
     */
    public function reminderRepository_ShouldRemoveOneEntity(): void
    {
        $reminderOne = new Reminder('Remind me Foo', new \DateTimeImmutable(), Frequency::ONCE);
        $reminderTwo = new Reminder('Remind me Bar', new \DateTimeImmutable(), Frequency::ONCE);

        $this->reminderRepository->save($reminderOne);
        $this->reminderRepository->save($reminderTwo);

        $this->reminderRepository->delete(1);

        $expectedEntitiesTotal = 1;
        $this->assertCount($expectedEntitiesTotal, $this->reminderRepository->all());
    }
}
