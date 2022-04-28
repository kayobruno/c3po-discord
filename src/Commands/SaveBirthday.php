<?php

declare(strict_types=1);

namespace App\Commands;

use App\Contracts\{Command, Entity, Repository};
use App\Handlers\SaveBirthdayHandler;

class SaveBirthday implements Command
{
    private Entity $birthday;
    private Repository $repository;

    public function __construct(private SaveBirthdayHandler $handler)
    {
        $this->repository = $this->handler->getRepository();
        $this->birthday = $this->handler->getBirthday();
    }

    public function execute(): void
    {
        $this->repository->save($this->birthday);
    }
}
