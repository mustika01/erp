<?php

namespace Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource;

class CreateDeliveryNote extends CreateRecord
{
    protected static string $resource = DeliveryNoteResource::class;

    protected static bool $canCreateAnother = false;
}
