<?php

namespace Kumi\Jinzai\Providers;

use Kumi\Jinzai\Support\DefaultRoles;
use Kumi\Jinzai\Support\DefaultAccess;
use Kumi\Kyoka\Support\Facades\Access;
use Illuminate\Support\ServiceProvider;
use Kumi\Jinzai\Support\DefaultPermissions;

class AccessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Access::registerRoles(DefaultRoles::getRoles());
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
