<?php

namespace Kumi\Jinzai\Tests\Models;

use Kumi\Jinzai\Models\JobPosition;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;

/**
 * @internal
 */
class JobPositionTest extends TestCase
{
    /** @test */
    public function it_can_get_code_attribute(): void
    {
        $position = JobPosition::factory()->create();

        $this->assertEquals('001', $position->code);
    }
}
