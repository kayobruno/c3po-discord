<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entities\Reminder;

class ReminderFactory extends AbstractReminderFactory
{
    public static function createReminder(string $message): Reminder
    {
        try {
            $title = self::extractTitle($message);
            $when = self::extractWhen($message);
            $frequency = self::extractFrequency($message);

            return new Reminder($title, $when, $frequency);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}