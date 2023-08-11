<?php

namespace Kumi\Zaimu\Tests\Cases;

use Kumi\Kensa\TestCase as BaseTestCase;

/**
 * @internal
 */
abstract class TestCase extends BaseTestCase
{
    public function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
    }

    protected function getPackageProviders($app)
    {
        return array_merge(
            parent::getPackageProviders($app),
            [
                ZaimuServiceProvider::class,
            ]
        );
    }
}
