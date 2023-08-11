<?php

namespace Kumi\Senzou\Filament\Resources\ItemResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Kumi\Senzou\Filament\Resources\ItemResource;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
