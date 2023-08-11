<?php

namespace Kumi\Jinzai\Tests\Models;

use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Identity;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;
use Kumi\Jinzai\Support\Enums\IdentityStatus;

/**
 * @internal
 */
class IdentityTest extends TestCase
{
    /** @test */
    public function it_belongs_to_an_employee(): void
    {
        $identity = Identity::factory()->identity_card()->create();

        $this->assertInstanceOf(Employee::class, $identity->employee);
    }

    /** @test */
    public function it_can_check_for_permanent_status(): void
    {
        $identity = Identity::factory()->identity_card()->create();

        $this->assertTrue($identity->isPermanent());
        $this->assertEquals(IdentityStatus::PERMANENT, $identity->status);
    }

    /** @test */
    public function it_can_check_for_active_status(): void
    {
        $identity = Identity::factory()->passport()->create();

        $this->assertTrue($identity->isActive());
        $this->assertEquals(IdentityStatus::ACTIVE, $identity->status);
    }

    /** @test */
    public function it_can_check_for_expired_status(): void
    {
        $identity = Identity::factory()->passport()->expired()->create();

        $this->assertTrue($identity->isExpired());
        $this->assertEquals(IdentityStatus::EXPIRED, $identity->status);
    }
}
