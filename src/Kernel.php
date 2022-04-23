<?php

declare(strict_types=1);

namespace App;

use App\Contracts\Wrapper;

class Kernel
{
    public function __construct(private Wrapper $wrapper, private DiscordEventManager $eventManager)
    {
        $this->registerEvents();
    }

    public function run()
    {
        $this->wrapper->run();
    }

    private function registerEvents()
    {
        $this->wrapper->on('ready', [$this->eventManager, 'ready']);
        $this->wrapper->on('message', [$this->eventManager, 'message']);
    }
}
