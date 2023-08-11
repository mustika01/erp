<?php

namespace Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DefaultPermissions;
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

        return $gate->check(DefaultPermissions::VIEW_ANY_EMPLOYEE_ACTIVITIES)
            || $gate->check(DefaultPermissions::VIEW_RECENT_EMPLOYEE_ACTIVITIES);
    }

    public function isTableSearchable(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_EMPLOYEE_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_EMPLOYEE_ACTIVITIES)
            && parent::isTableSearchable();
    }

    protected function isTablePaginationEnabled(): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_ANY_EMPLOYEE_ACTIVITIES)
            && $gate->check(DefaultPermissions::VIEW_RECENT_EMPLOYEE_ACTIVITIES);
    }

    protected function canView(Model $record): bool
    {
        $gate = Gate::forUser(
            Filament::auth()->user()
        );

        return $gate->check(DefaultPermissions::VIEW_EMPLOYEE_ACTIVITY);
    }

    protected function checkActivityDetailsPermission(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_EMPLOYEE_ACTIVITY_DETAILS);
    }
}
