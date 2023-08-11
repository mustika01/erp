<?php

namespace Kumi\Kiosk\Filament\Resources\PersonalTicketResource\RelationManagers;

use Illuminate\Database\Eloquent\Model;
use Kumi\Kanshi\Filament\RelationManagers\ActivitiesRelationManager as BaseActivitiesRelationManager;

/**
 * @codeCoverageIgnore
 */
class ActivitiesRelationManager extends BaseActivitiesRelationManager
{
    public static function canViewForRecord(Model $ownerRecord): bool
    {
        return true;
    }

    public function isTableSearchable(): bool
    {
        return false;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function canView(Model $record): bool
    {
        return false;
    }
}
