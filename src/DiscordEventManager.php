<?php

declare(strict_types=1);

namespace App;

use App\Contracts\Repository;
use App\Factory\ReminderFactory;
use App\Handlers\SaveReminderHandler;
use App\Wrapper\DiscordWrapper;
use Discord\Parts\Channel\Message;

class DiscordEventManager
{
    public function __construct(private Repository $repository)
    {}

    public function ready(DiscordWrapper $discordWrapper)
    {
        echo 'Bot is ready!' . PHP_EOL;
    }

    /**
     * @throws \Exception
     */
    public function message(Message $message, DiscordWrapper $discordWrapper)
    {
        if ($message->author->bot) return;

        if ($message->content === '$ping') {
            $message->reply('Pong!');
        }

        if (str_contains($message->content, '$remindme')) {
            $reminder = ReminderFactory::createReminder($message->content);
            $createReminderHandler = new SaveReminderHandler($this->repository, $reminder);
            $createReminderHandler->execute();

            $message->reply('Reminder was saved!');
        }
    }
}