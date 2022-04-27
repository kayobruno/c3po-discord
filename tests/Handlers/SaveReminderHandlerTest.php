<?php

declare(strict_types=1);

namespace Tests\Handlers;

use App\Entities\Reminder;
use App\Handlers\SaveReminderHandler;
use App\Repositories\ReminderRepository;
use PHPUnit\Framework\TestCase;

class SaveReminderHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function saveReminderHandler_ShouldSucceed(): void
    {
        $repositoryMock = $this->createMock(ReminderRepository::class);
        $reminderMock = $this->createMock(Reminder::class);

        $repositoryMock->expects($this->once())->method('save')->with($reminderMock);

        $saveReminderHandler = new SaveReminderHandler($repositoryMock, $reminderMock);
        $saveReminderHandler->execute();
    }
}