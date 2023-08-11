<?php

namespace Kumi\Jinzai\Filament\Resources\PayrollResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Kumi\Jinzai\Filament\Resources\PayrollResource;

class CreatePayroll extends CreateRecord
{
    protected static string $resource = PayrollResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tax_number'] ??= '00.000.000.0-000.000';

        return $data;
    }
}
