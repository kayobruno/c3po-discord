<?php

declare(strict_types=1);

namespace App\Commands;

use App\Handlers\CreateReminderHandler;
use App\Contracts\{Command, Entity, Repository};

class CreateReminder implements Command
{
    private Entity $reminder;
    private Repository $repository;

    public function __construct(private CreateReminderHandler $handler)
    {
        $this->repository = $this->handler->getRepository();
        $this->reminder = $this->handler->getReminder();
    }

    public function execute(): void
    {
        $this->repository->save($this->reminder);
    }
}
