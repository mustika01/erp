<?php

namespace Kumi\Tobira\Providers;

use Kumi\Kyoka\Support\Facades\Access;
use Kumi\Tobira\Support\DefaultAccess;
use Illuminate\Support\ServiceProvider;
use Kumi\Tobira\Support\DefaultPermissions;

class AccessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
