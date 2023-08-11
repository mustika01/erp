<?php

namespace Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;
}
