<?php

namespace Kumi\Jinzai\Tests\Models;

use Kumi\AbstractJinzaiKiosk\Tests\TestCase;
use Kumi\Jinzai\Models\OnboardingLink;

/**
 * @internal
 */
class OnboardingLinkTest extends TestCase
{
    /** @test */
    public function it_can_return_edit_url(): void
    {
        $link = OnboardingLink::factory()->create();

        $this->assertEquals(route('filament.onboarding.edit', ['link' => $link]), $link->getEditUrl());
    }
}
