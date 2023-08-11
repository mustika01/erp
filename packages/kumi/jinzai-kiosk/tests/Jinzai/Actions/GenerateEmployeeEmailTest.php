<?php

namespace Kumi\Jinzai\Tests\Actions;

use Kumi\AbstractJinzaiKiosk\Tests\TestCase;
use Kumi\Jinzai\Actions\GenerateEmployeeEmail;

/**
 * @internal
 */
class GenerateEmployeeEmailTest extends TestCase
{
    /** @test */
    public function it_can_generate_email_with_3_names(): void
    {
        $email = GenerateEmployeeEmail::run('Jack Captain Sparrow');

        $this->assertEquals('jack.sparrow@em.lbn.co.id', $email);
    }

    /** @test */
    public function it_can_generate_email_with_2_names(): void
    {
        $email = GenerateEmployeeEmail::run('Jack Sparrow');

        $this->assertEquals('jack.sparrow@em.lbn.co.id', $email);
    }

    /** @test */
    public function it_can_generate_email_with_1_name(): void
    {
        $email = GenerateEmployeeEmail::run('Jack');

        $this->assertEquals('jack@em.lbn.co.id', $email);
    }
}
