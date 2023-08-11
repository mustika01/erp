<?php

namespace Kumi\Kensa;

use Kumi\Kensa\Traits\InteractsWithUserAuthentication;

/**
 * @internal
 */
abstract class AdministratorTestCase extends TestCase
{
    use InteractsWithUserAuthentication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAsAdministrator();
    }
}
