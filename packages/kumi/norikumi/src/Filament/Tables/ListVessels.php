<?php

namespace Kumi\Norikumi\Filament\Tables;

use Filament\Tables;
use Livewire\Component;
use Kumi\Sousa\Models\Vessel;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Norikumi\Filament\Tables\ListVessels\Actions;

class ListVessels extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public function render(): View
    {
        return view('norikumi::filament.tables.list-vessels');
    }

    protected function getTableQuery(): Builder
    {
        return Vessel::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label(__('norikumi::filament/resources/assignment.columns.vessel.label'))
                ->searchable(),
            Tables\Columns\TextColumn::make('assignments_count')
                ->label(__('norikumi::filament/resources/assignment.columns.assignments_count.label'))
                ->formatStateUsing(function (Model $record) {
                    return $record
                        ->assignments()
                        ->getQuery()
                        ->whereNull('retracted_at')
                        ->count()
                    ;
                }),
        ];
    }

    protected function getTableFilters(): array
    {
        return [];
    }

    protected function getTableActions(): array
    {
        return [
            Actions\AssignmentsAction::make(),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
