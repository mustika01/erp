<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Kumi\Kyoka\Filament\Resources\UserResource;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
}
