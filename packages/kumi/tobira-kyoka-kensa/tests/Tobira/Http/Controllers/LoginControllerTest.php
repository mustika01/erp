<?php

namespace Kumi\Tobira\Tests\Http\Controllers;

use Kumi\Kensa\TestCase;

/**
 * @internal
 */
class LoginControllerTest extends TestCase
{
    /** @test */
    public function it_can_redirect_to_filament_login_page(): void
    {
        $this->get(route('login'))
            ->assertRedirect(route('filament.session.create'))
        ;
    }
}
