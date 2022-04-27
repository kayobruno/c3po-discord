<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entities\Reminder;
use InvalidArgumentException;

class ReminderFactory extends AbstractReminderFactory
{
    public static function createReminder(string $message): Reminder
    {
        self::validateMessage($message);

        $title = self::extractTitle($message);
        $when = self::extractWhen($message);
        $frequency = self::extractFrequency($message);

        return new Reminder($title, $when, $frequency);
    }

    private static function validateMessage(string $message): void
    {
        if (!str_contains($message, '$remindme')) {
            throw new InvalidArgumentException('Message is invalid!');
        }
    }
}