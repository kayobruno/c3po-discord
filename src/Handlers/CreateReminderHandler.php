<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\CreateReminder;
use App\Contracts\{Command, Entity, Repository};

class CreateReminderHandler implements Command
{
    public function __construct(private Repository $repository, private Entity $reminder)
    {}

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function getReminder(): Entity
    {
        return $this->reminder;
    }

    public function execute(): void
    {
        $command = new CreateReminder($this);
        $command->execute();
    }
}
