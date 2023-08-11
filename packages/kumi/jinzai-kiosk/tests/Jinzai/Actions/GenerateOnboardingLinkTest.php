<?php

namespace Kumi\Jinzai\Tests\Actions;

use Kumi\Jinzai\Models\Employee;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;
use Kumi\Jinzai\Models\OnboardingLink;
use Kumi\Jinzai\Actions\GenerateOnboardingLink;

/**
 * @internal
 */
class GenerateOnboardingLinkTest extends TestCase
{
    /** @test */
    public function it_can_generate_onboarding_link(): void
    {
        $employee = Employee::factory()->create();

        $this->assertNull($employee->onboardingLink);

        GenerateOnboardingLink::run($employee);

        $this->assertInstanceOf(OnboardingLink::class, $employee->fresh()->onboardingLink);
    }

    /** @test */
    public function it_can_handle_existing_onboarding_link(): void
    {
        $employee = Employee::factory()
            ->has(OnboardingLink::factory(), 'onboardingLink')
            ->create()
        ;

        $link = $employee->onboardingLink;

        $this->assertInstanceOf(OnboardingLink::class, $link);

        GenerateOnboardingLink::run($employee);

        $this->assertTrue($employee->fresh()->onboardingLink->is($link));
    }
}
