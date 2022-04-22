<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entities\Reminder;

class ReminderFactory extends AbstractReminderFactory
{
    /**
     * @throws \Exception
     */
    public static function createReminder(string $message): Reminder
    {
        $title = self::extractTitle($message);
        $when = self::extractWhen($message);
        $frequency = self::extractFrequency($message);

        return new Reminder($title, $when, $frequency);
    }
}