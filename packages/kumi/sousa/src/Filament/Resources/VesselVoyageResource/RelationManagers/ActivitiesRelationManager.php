<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\RelationManagers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Support\DefaultPermissions;
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

        return $gate->check(DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES)
            || $gate->check(DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES);
    }

    public function isTableSearchable(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES)
            && parent::isTableSearchable();
    }

    protected function isTablePaginationEnabled(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES);
    }

    protected function canView(Model $record): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY);
    }

    protected function checkActivityDetailsPermission(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS);
    }
}
