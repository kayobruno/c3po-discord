<?php

declare(strict_types=1);

use App\DiscordEventManager;
use App\Kernel;
use App\Repositories\ReminderRepository;
use App\Wrapper\DiscordWrapper;
use Psr\Container\ContainerInterface;

return [
    DiscordEventManager::class => (function(ContainerInterface $container) {
        return new DiscordEventManager($container->get(ReminderRepository::class));
    }),
    Kernel::class => (function(ContainerInterface $container) {
        $token = getenv('DISCORD_TOKEN');
        $wrapper = new DiscordWrapper(['token' => $token]);

        return new Kernel($wrapper, $container->get(DiscordEventManager::class));
    }),
];