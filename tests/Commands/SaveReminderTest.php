<?php

declare(strict_types=1);

namespace Tests\Commands;

use App\Commands\SaveReminder;
use App\Handlers\SaveReminderHandler;
use PHPUnit\Framework\TestCase;

class SaveReminderTest extends TestCase
{
    /**
     * @test
     */
    public function saveReminderCommand_ShouldSucceed(): void
    {
        $saveReminderHandlerMock = $this->createMock(SaveReminderHandler::class);

        $saveReminderHandlerMock->expects($this->once())->method('getRepository');
        $saveReminderHandlerMock->expects($this->once())->method('getReminder');

        $saveReminder = new SaveReminder($saveReminderHandlerMock);
        $saveReminder->execute();
    }
}