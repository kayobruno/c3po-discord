<?php

declare(strict_types=1);

namespace Tests\Entities;

use App\Contracts\Entity;
use App\Entities\Reminder;
use App\Enumerations\Frequency;
use PHPUnit\Framework\TestCase;

class ReminderTest extends TestCase
{
    public function getReminder(): \Generator
    {
        $when = new \DateTimeImmutable();
        $reminder = new Reminder('Remind me foo', $when, Frequency::ONCE);

        yield 'Valid Reminder' => [$reminder];
    }

    /**
     * @test
     * @dataProvider getReminder
     */
    public function reminderEntity_ShouldImplementsCorrectContract($reminder): void
    {
        $this->assertInstanceOf(Entity::class, $reminder);
    }

    /**
     * @test
     * @dataProvider getReminder
     */
    public function reminderEntity_ShouldReturnCorrectTableName($reminder): void
    {
        $expectedTableName = 'reminder';
        $this->assertEquals($expectedTableName, $reminder->getTableName());
    }
}