<?php

namespace Kumi\Norikumi\Filament\Resources\CrewResource\RelationManagers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Kumi\Norikumi\Support\DefaultPermissions;
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

        return $gate->check(DefaultPermissions::VIEW_ANY_CREW_ACTIVITIES)
            || $gate->check(DefaultPermissions::VIEW_RECENT_CREW_ACTIVITIES);
    }

    public function isTableSearchable(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_CREW_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_CREW_ACTIVITIES)
            && parent::isTableSearchable();
    }

    protected function isTablePaginationEnabled(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_CREW_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_CREW_ACTIVITIES);
    }

    protected function canView(Model $record): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_CREW_ACTIVITY);
    }

    protected function checkActivityDetailsPermission(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_CREW_ACTIVITY_DETAILS);
    }
}
