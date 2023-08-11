<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Kumi\Kanshi\Filament\RelationManagers\ActivitiesRelationManager as BaseActivitiesRelationManager;
use Kumi\Norikumi\Support\DefaultPermissions;

class ActivitiesRelationManager extends BaseActivitiesRelationManager
{
    public static function canViewForRecord(Model $ownerRecord): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_PAYROLL_ACTIVITIES)
            || $gate->check(DefaultPermissions::VIEW_RECENT_PAYROLL_ACTIVITIES);
    }

    public function isTableSearchable(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_PAYROLL_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_PAYROLL_ACTIVITIES)
            && parent::isTableSearchable();
    }

    protected function isTablePaginationEnabled(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_PAYROLL_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_PAYROLL_ACTIVITIES);
    }

    protected function canView(Model $record): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_PAYROLL_ACTIVITY);
    }
}
