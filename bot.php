<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;

require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->safeLoad();

$token = getenv('DISCORD_TOKEN');
$discord = new Discord(['token' => $token]);

$discord->on('ready', function (Discord $discord) {
    echo 'Bot is ready!' . PHP_EOL;

    $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
        if ($message->author->bot) return;

        if ($message->content === '$ping') {
            $message->reply('Pong!');
        }
    });
});

$discord->run();
