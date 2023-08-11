<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Kumi\Senzou\Filament\Resources\RequestNoteResource;

class EditRequestNote extends EditRecord
{
    protected static string $resource = RequestNoteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
