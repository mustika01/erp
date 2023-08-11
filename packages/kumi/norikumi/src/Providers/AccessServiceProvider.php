<?php

namespace Kumi\Norikumi\Providers;

use Kumi\Kyoka\Support\Facades\Access;
use Illuminate\Support\ServiceProvider;
use Kumi\Norikumi\Support\DefaultRoles;
use Kumi\Norikumi\Support\DefaultAccess;
use Kumi\Norikumi\Support\DefaultPermissions;

class AccessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Access::registerRoles(DefaultRoles::getRoles());
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
