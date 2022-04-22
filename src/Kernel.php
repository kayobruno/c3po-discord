<?php

declare(strict_types=1);

namespace App;

use App\Factory\ReminderFactory;
use App\Handlers\SaveReminderHandler;
use Discord\Discord;
use App\Contracts\{Repository, Wrapper};
use Discord\Parts\Channel\Message;

class Kernel
{
    public function __construct(private Wrapper $wrapper, private Repository $repository)
    {
        $this->ready();
        $this->message();
    }

    public function run()
    {
        $this->wrapper->run();
    }

    private function ready()
    {
        $this->wrapper->on('ready', function (Discord $discordWrapper) {
            echo 'Bot is ready!' . PHP_EOL;
        });
    }

    private function message()
    {
        try {
            $this->wrapper->on('message', function (Message $message, Discord $discordWrapper) {
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
            });
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
