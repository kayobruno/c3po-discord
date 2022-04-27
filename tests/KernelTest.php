<?php

declare(strict_types=1);

namespace Tests;

use App\DiscordEventManager;
use App\Kernel;
use App\Wrapper\DiscordWrapper;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    /**
     * @test
     */
    public function kernel_ShouldStartApplication(): void
    {
        $wrapperMock = $this->createMock(DiscordWrapper::class);
        $eventManagerMock = $this->createMock(DiscordEventManager::class);

        $wrapperMock->expects($this->exactly(2))
            ->method('on')
            ->withConsecutive(
                ['ready', [$eventManagerMock, 'ready']],
                ['message', [$eventManagerMock, 'message']]
            );

        $kernel = new Kernel($wrapperMock, $eventManagerMock);
        $kernel->run();
    }
}
