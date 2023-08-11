<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\RelationManagers;

use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\PersonalTicket;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kanri\Support\DefaultPermissions;
use Kumi\Kanshi\Filament\RelationManagers\ActivitiesRelationManager as BaseActivitiesRelationManager;

/**
 * @codeCoverageIgnore
 */
class ActivitiesRelationManager extends BaseActivitiesRelationManager
{
    public function mount(): void
    {
        $this->ownerRecord = PersonalTicket::find($this->getOwnerRecord()->getKey());
    }

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
        return true;
    }

    protected function checkActivityDetailsPermission(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_TICKET_ACTIVITY_DETAILS);
    }
}
