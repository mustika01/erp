<?php

namespace Kumi\Kyoka\Support\Facades;

use Kumi\Kyoka\Auth\AccessManager;
use Illuminate\Support\Facades\Facade;

class Access extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return AccessManager::class;
    }
}
