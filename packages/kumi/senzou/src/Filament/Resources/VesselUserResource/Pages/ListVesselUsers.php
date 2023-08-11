<?php

namespace Kumi\Senzou\Filament\Resources\VesselUserResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Hash;
use Kumi\Senzou\Filament\Resources\VesselUserResource;

class ListVesselUsers extends ListRecords
{
    protected static ?string $title = 'Users';

    protected static string $resource = VesselUserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modelLabel('user')
                ->disableCreateAnother()
                ->mutateFormDataUsing(function (array $data) {
                    $data['password'] = Hash::make($data['password']);

                    return $data;
                }),
        ];
    }
}
