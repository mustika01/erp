<?php

namespace Kumi\Sousa\Tests\Cases;

use Kumi\Sousa\SousaServiceProvider;
use Kumi\Kensa\TestCase as BaseTestCase;
use Saade\FilamentFullCalendar\FilamentFullCalendarServiceProvider;

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
                SousaServiceProvider::class,
                FilamentFullCalendarServiceProvider::class,
            ]
        );
    }
}
