<?php

namespace Kumi\Sousa\Filament\Resources\BunkerResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Kumi\Sousa\Filament\Resources\BunkerResource;

class EditBunker extends EditRecord
{
    protected static string $resource = BunkerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
