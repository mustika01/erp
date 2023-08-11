<?php

namespace Kumi\Kanshi\Tests\Cases;

use Kumi\Kanshi\KanshiServiceProvider;
use Kumi\Kensa\TestCase as BaseTestCase;
use Spatie\Activitylog\ActivitylogServiceProvider as SpatieActivityLogServiceProvider;

/**
 * @internal
 */
abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return array_merge(
            parent::getPackageProviders($app),
            [
                KanshiServiceProvider::class,
                SpatieActivityLogServiceProvider::class,
            ]
        );
    }
}
