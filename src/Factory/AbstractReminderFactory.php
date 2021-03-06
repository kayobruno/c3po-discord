<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entities\Reminder;
use App\Enumerations\Frequency;
use DateTime;
use DateTimeImmutable;
use InvalidArgumentException;

abstract class AbstractReminderFactory
{
    abstract public static function createReminder(string $message): Reminder;

    protected static function extractTitle(string $message): string
    {
        $message = str_replace('$remindme', '', $message);
        $message = preg_replace("/{.*?}/", '', $message);

        return trim($message);
    }

    /**
     * @throws \Exception
     */
    protected static function extractWhen(string $message): DateTimeImmutable
    {
        $split = self::splitMessage($message);
        $when = self::formatDate($split[1]);

        return new DateTimeImmutable($when);
    }

    protected static function extractFrequency(string $message): Frequency
    {
        $split = self::splitMessage($message);
        preg_match('#\{(.*?)\}#', $split[0], $match);

        return count($match) ? Frequency::from($match[1]) : Frequency::ONCE;
    }

    private static function splitMessage(string $message): array
    {
        $message = trim(str_replace('$remindme', '', $message));
        return explode(' ', $message);
    }

    private static function formatDate(string $stringTime): string
    {
        $now = new DateTime();
        $numberTime = preg_replace('/[^0-9]/', '', $stringTime);

        $date = match (true) {
            strlen($stringTime) >= 6 => self::processCompleteDate($stringTime),
            str_contains($stringTime, 's') => $now->modify("+{$numberTime} seconds"),
            str_contains($stringTime, 'm') => $now->modify("+{$numberTime} minutes"),
            str_contains($stringTime, 'h') => $now->modify("+{$numberTime} hours"),
            str_contains($stringTime, 'd') => $now->modify("+{$numberTime} days"),
            default => throw new InvalidArgumentException('Invalid time'),
        };

        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @throws \Exception
     */
    private static function processCompleteDate(string $stringTime): DateTime
    {
        preg_match('#\{(.*?)\}#', $stringTime, $match);
        $datetime = str_replace('_', ' ', $match[1]);

        return new DateTime($datetime);
    }
}
