<?php

namespace Kumi\Jinzai\Tests\Actions;

use Illuminate\Support\Facades\Hash;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;
use Kumi\Jinzai\Actions\GenerateRandomPassword;

/**
 * @internal
 */
class GenerateRandomPasswordTest extends TestCase
{
    /** @test */
    public function it_can_generate_random_password(): void
    {
        $password = GenerateRandomPassword::run();
        $hashInfo = Hash::info($password);

        $this->assertEquals('bcrypt', $hashInfo['algoName']);
    }
}
