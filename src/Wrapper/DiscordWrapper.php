<?php

declare(strict_types=1);

namespace App\Wrapper;

use App\Contracts\Wrapper;
use Discord\{Discord, Parts\Channel\Message};

class DiscordWrapper extends Discord implements Wrapper
{
    public function registerEvents()
    {
        $this->on('ready', function (Discord $discord) {
            echo 'Bot is ready!' . PHP_EOL;
            $this->on('message', [$this, 'messageListener']);
        });
    }

    public function messageListener(Message $message, Discord $discord): void
    {
        if ($message->author->bot) return;

        if ($message->content === '$ping') {
            $message->reply('Pong!');
        }
    }
}
