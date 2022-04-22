<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\SaveReminder;
use App\Contracts\{Command, Entity, Repository};
use App\Entities\Reminder;

class SaveReminderHandler implements Command
{
    public function __construct(private Repository $repository, private Reminder $reminder)
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
        $command = new SaveReminder($this);
        $command->execute();
    }
}
