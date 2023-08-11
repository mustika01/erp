<?php

namespace Kumi\Kyoka\Filament\Resources\RoleResource\Pages;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\ListRecords;
use Kumi\Kyoka\Filament\Resources\RoleResource;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    /**
     * @codeCoverageIgnore
     */
    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            $resource = static::getResource();
            $isEditable = $record->is_editable;

            if ($resource::hasPage('view') && $resource::canView($record)) {
                return $resource::getUrl('view', ['record' => $record]);
            }

            if ($resource::hasPage('edit') && $resource::canEdit($record) && $isEditable) {
                return $resource::getUrl('edit', ['record' => $record]);
            }

            return null;
        };
    }
}
