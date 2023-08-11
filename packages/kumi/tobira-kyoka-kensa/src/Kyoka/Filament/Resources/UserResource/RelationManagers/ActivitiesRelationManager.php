<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\RelationManagers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Support\DefaultPermissions;
use Kumi\Kanshi\Filament\RelationManagers\ActivitiesRelationManager as BaseActivitiesRelationManager;

/**
 * @codeCoverageIgnore
 */
class ActivitiesRelationManager extends BaseActivitiesRelationManager
{
    public static function canViewForRecord(Model $ownerRecord): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_USER_ACTIVITIES)
            || $gate->check(DefaultPermissions::VIEW_RECENT_USER_ACTIVITIES);
    }

    public function isTableSearchable(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_USER_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_USER_ACTIVITIES)
            && parent::isTableSearchable();
    }

    protected function isTablePaginationEnabled(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_USER_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_USER_ACTIVITIES);
    }

    protected function canView(Model $record): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_USER_ACTIVITY);
    }
}
