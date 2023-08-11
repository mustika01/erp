<?php

namespace Kumi\Jinzai\Tests\Http\Controllers;

use Kumi\Jinzai\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Kumi\Jinzai\Models\OnboardingLink;
use Kumi\Jinzai\Events\Employee\Onboarded;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Events\Listeners\LogEmployeeOnboardedEvent;

/**
 * @internal
 */
class OnboardingControllerTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_onboarding_page(): void
    {
        $link = OnboardingLink::factory()->create();

        $response = $this->get(route('filament.onboarding.edit', ['link' => $link]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_handle_expired_onboarding_link(): void
    {
        $link = OnboardingLink::factory()->expired()->create();

        $response = $this->get(route('filament.onboarding.edit', ['link' => $link]));

        $response->assertNotFound();
    }

    /** @test */
    public function it_can_handle_employee_who_has_been_through_onboarding(): void
    {
        $employee = Employee::factory()
            ->onboarded()
            ->create()
        ;

        $link = $employee->onboardingLink;

        $response = $this->get(route('filament.onboarding.edit', ['link' => $link]));

        $response->assertNotFound();
    }

    /** @test */
    public function it_can_handle_employee_onboarding(): void
    {
        Event::fake();

        $employee = Employee::factory()
            ->has(OnboardingLink::factory(), 'onboardingLink')
            ->create()
        ;

        $this->put(route('filament.onboarding.update', ['link' => $employee->onboardingLink]), [
            'name' => $employee->user->name,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertTrue(Hash::check('password', $employee->user->fresh()->password));
        $this->assertTrue($employee->fresh()->hasBeenThroughOnboarding());

        Event::assertDispatched(Onboarded::class);
        Event::assertListening(Onboarded::class, LogEmployeeOnboardedEvent::class);
    }
}
