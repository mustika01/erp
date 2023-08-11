<?php

namespace Kumi\Kiosk\Filament\Resources\PersonalTicketResource\Pages;

use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Kumi\Kiosk\Filament\Resources\PersonalTicketResource;

class CreatePersonalTicket extends CreateRecord
{
    protected static string $resource = PersonalTicketResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['employee_id'] = Auth::user()->employee->id;
        $data['status'] = TicketStatus::PENDING;

        return $data;
    }
}
