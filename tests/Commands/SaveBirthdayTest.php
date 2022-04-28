<?php

declare(strict_types=1);

namespace Tests\Commands;

use App\Commands\SaveBirthday;
use App\Handlers\SaveBirthdayHandler;
use PHPUnit\Framework\TestCase;

class SaveBirthdayTest extends TestCase
{
    /**
     * @test
     */
    public function saveBirthdayCommand_ShouldSucceed(): void
    {
        $saveBirthdayHandlerMock = $this->createMock(SaveBirthdayHandler::class);

        $saveBirthdayHandlerMock->expects($this->once())->method('getRepository');
        $saveBirthdayHandlerMock->expects($this->once())->method('getBirthday');

        $saveBirthday = new SaveBirthday($saveBirthdayHandlerMock);
        $saveBirthday->execute();
    }
}