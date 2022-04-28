<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\SaveBirthday;
use App\Entities\Birthday;
use App\Contracts\{Command, Entity, Repository};

class SaveBirthdayHandler implements Command
{
    public function __construct(private Repository $repository, private Birthday $birthday)
    {}

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function getBirthday(): Entity
    {
        return $this->birthday;
    }

    public function execute(): void
    {
        $command = new SaveBirthday($this);
        $command->execute();
    }
}
