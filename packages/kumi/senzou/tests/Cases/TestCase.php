<?php

namespace Kumi\Senzou\Tests\Cases;

use Kumi\Kensa\TestCase as BaseTestCase;
use Kumi\Senzou\SenzouServiceProvider;

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
                SenzouServiceProvider::class,
            ]
        );
    }
}
