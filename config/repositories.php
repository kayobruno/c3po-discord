<?php

declare(strict_types=1);

use App\Repositories\{MySQLReminderPersistence, ReminderRepository};
use Psr\Container\ContainerInterface;

return [
    ReminderRepository::class => (function (ContainerInterface $container) {
        return new ReminderRepository(new MySQLReminderPersistence());
    }),
];