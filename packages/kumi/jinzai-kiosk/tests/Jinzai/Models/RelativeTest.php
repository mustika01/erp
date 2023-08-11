<?php

namespace Kumi\Jinzai\Tests\Models;

use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Relative;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;

/**
 * @internal
 */
class RelativeTest extends TestCase
{
    /** @test */
    public function it_belongs_to_an_employee(): void
    {
        $relative = Relative::factory()->create();

        $this->assertInstanceOf(Employee::class, $relative->employee);
    }
}
