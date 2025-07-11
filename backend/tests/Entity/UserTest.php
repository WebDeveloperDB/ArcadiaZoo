<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testTheAutomaticApiTokenSettingWhenAnUserIsCreated(): void
    {
        $user = new User();
        $this->assertNotNull($user->getApiToken());
    }

    public function testAnException(): void
    {
        $this->expectException(\TypeError::class);
        $user = new User();
        $user->setPrenom([10]);
    }


    public function provideFirstName(): \Generator
    {
        yield ['Thomas'];
        yield ['Eric'];
        yield ['Marie'];
    }
    /** @dataProvider provideFirstName */
    public function testFirstNameSetter(string $name): void
    {
        $user = new User();
        $user->setPrenom($name);
        $this->assertSame($name, $user->getPrenom());
    }
}