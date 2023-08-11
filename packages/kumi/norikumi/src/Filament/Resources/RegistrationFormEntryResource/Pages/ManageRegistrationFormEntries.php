<?php

namespace Kumi\Norikumi\Filament\Resources\RegistrationFormEntryResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Kumi\Norikumi\Actions\GenerateRandomPINCode;
use Kumi\Norikumi\Filament\Resources\RegistrationFormEntryResource;

class ManageRegistrationFormEntries extends ManageRecords
{
    protected static string $resource = RegistrationFormEntryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->disableCreateAnother()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['pin_code'] = GenerateRandomPINCode::run();

                    return $data;
                }),
        ];
    }
}
