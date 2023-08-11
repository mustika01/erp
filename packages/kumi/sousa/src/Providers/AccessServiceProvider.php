<?php

namespace Kumi\Sousa\Providers;

use Kumi\Sousa\Support\DefaultRoles;
use Kumi\Sousa\Support\DefaultAccess;
use Kumi\Kyoka\Support\Facades\Access;
use Illuminate\Support\ServiceProvider;
use Kumi\Sousa\Support\DefaultPermissions;

class AccessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Access::registerRoles(DefaultRoles::getRoles());
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
