<?php

declare(strict_types=1);

namespace Tests\Entities;

use App\Contracts\Entity;
use App\Entities\Birthday;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class BirthdayTest extends TestCase
{
    public function getBirthday()
    {
        $when = new DateTimeImmutable('1992-12-17');
        $birthday = new Birthday('Kayo', $when);

        yield 'Valid Birthday' => [$birthday];
    }
    /**
     * @test
     * @dataProvider getBirthday
     */
    public function birthdayEntity_ShouldImplementsCorrectContract($birthday): void
    {
        $this->assertInstanceOf(Entity::class, $birthday);
    }

    /**
     * @test
     * @dataProvider getBirthday
     */
    public function birthdayEntity_ShouldReturnCorrectTableName($birthday): void
    {
        $expectedTableName = 'birthday';
        $this->assertEquals($expectedTableName, $birthday->getTableName());
    }
}