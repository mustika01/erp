<?php

namespace Kumi\AbstractJinzaiKiosk\Tests;

use Kumi\Kensa\Traits\InteractsWithUserAuthentication;

/**
 * @internal
 */
abstract class AuthenticatedTestCase extends TestCase
{
    use InteractsWithUserAuthentication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAsFilamentUser();
    }
}
