<?php

declare(strict_types=1);

namespace Tests\Factory;

use App\Entities\Reminder;
use App\Factory\ReminderFactory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ReminderFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function reminderFactory_ShouldCreateReminderWithCompleteDate(): void
    {
        $message = '$remindme {once} {2022-04-22_08:00:00} Avise-me sobre o envio da folha de ponto';
        $reminder = ReminderFactory::createReminder($message);

        $this->assertInstanceOf(Reminder::class, $reminder);
    }

    /**
     * @test
     */
    public function reminderFactory_ShouldCreateReminderWithDays(): void
    {
        $message = '$remindme {once} {03d} Avise-me sobre o envio da folha de ponto';
        $reminder = ReminderFactory::createReminder($message);

        $now = new \DateTime();
        $diff = $now->diff($reminder->getWhen());

        $expectedTotalDays = 2;
        $expectedTotalHours = 23;

        $this->assertEquals($expectedTotalDays, $diff->days);
        $this->assertEquals($expectedTotalHours, $diff->h);
        $this->assertInstanceOf(Reminder::class, $reminder);
    }

    /**
     * @test
     */
    public function reminderFactory_ShouldCreateReminderWithHours(): void
    {
        $message = '$remindme {once} {03h} Avise-me sobre o envio da folha de ponto';
        $reminder = ReminderFactory::createReminder($message);

        $now = new \DateTime();
        $diff = $now->diff($reminder->getWhen());

        $expectedTotalHours = 2;
        $expectedTotalMinutes = 59;

        $this->assertEquals($expectedTotalHours, $diff->h);
        $this->assertEquals($expectedTotalMinutes, $diff->i);
        $this->assertInstanceOf(Reminder::class, $reminder);
    }

    /**
     * @test
     */
    public function reminderFactory_ShouldCreateReminderWithMinutes(): void
    {
        $message = '$remindme {once} {03m} Avise-me sobre o envio da folha de ponto';
        $reminder = ReminderFactory::createReminder($message);

        $now = new \DateTime();
        $diff = $now->diff($reminder->getWhen());

        $expectedTotalMinutes = 2;
        $expectedTotalSeconds = 59;

        $this->assertEquals($expectedTotalMinutes, $diff->i);
        $this->assertEquals($expectedTotalSeconds, $diff->s);
        $this->assertInstanceOf(Reminder::class, $reminder);
    }

    /**
     * @test
     */
    public function reminderFactory_ShouldCreateReminderWithSeconds(): void
    {
        $message = '$remindme {once} {30s} Avise-me sobre o envio da folha de ponto';
        $reminder = ReminderFactory::createReminder($message);

        $now = new \DateTime();
        $diff = $now->diff($reminder->getWhen());

        $expectedTotalSeconds = 29;

        $this->assertEquals($expectedTotalSeconds, $diff->s);
        $this->assertInstanceOf(Reminder::class, $reminder);
    }

    /**
     * @test
     */
    public function reminderFactory_ShouldThrowExceptionWhenMessageIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Message is invalid!');

        $message = 'test';
        ReminderFactory::createReminder($message);
    }
}