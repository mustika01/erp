<?php

namespace Kumi\Yoyaku\Filament\Resources\BookableResource\Pages;

use Kumi\Yoyaku\Filament\Resources\BookableResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookable extends CreateRecord
{
    protected static string $resource = BookableResource::class;
}
