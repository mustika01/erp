<?php

namespace Kumi\Senzou\Providers;

use Illuminate\Support\ServiceProvider;
use Kumi\Kyoka\Support\Facades\Access;
use Kumi\Senzou\Support\DefaultAccess;
use Kumi\Senzou\Support\DefaultPermissions;
use Kumi\Senzou\Support\DefaultRoles;

class AccessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Access::registerRoles(DefaultRoles::getRoles());
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
