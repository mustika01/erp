<?php

namespace Kumi\Norikumi\Filament\Tables;

use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Norikumi\Filament\Tables\ListAssignments\Actions;
use Kumi\Sousa\Models\Vessel;
use Livewire\Component;

class ListAssignments extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public Vessel $vessel;

    public function render(): View
    {
        return view('norikumi::filament.tables.list-assignments');
    }

    protected function getTableQuery(): Builder
    {
        return $this->vessel
            ->assignments()
            ->getQuery()
            ->whereNull('retracted_at')
            ->ordered()
        ;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('crew.name')
                ->label(__('norikumi::filament/resources/assignment.columns.crew.label'))
                ->searchable(),
            Tables\Columns\TextColumn::make('position')
                ->label(__('norikumi::filament/resources/assignment.columns.position.label'))
                ->formatStateUsing(function (string $state) {
                    return __('norikumi::filament/resources/assignment.columns.position.options.' . $state);
                }),
            Tables\Columns\TextColumn::make('grade')
                ->label(__('norikumi::filament/resources/assignment.columns.grade.label')),
            Tables\Columns\TextColumn::make('assigned_at_formatted')
                ->label(__('norikumi::filament/resources/assignment.columns.assigned_at_formatted.label')),
            // Tables\Columns\TextColumn::make('retracted_at_formatted')
            //     ->label(__('norikumi::filament/resources/assignment.columns.retracted_at_formatted.label')),
        ];
    }

    protected function getTableFilters(): array
    {
        return [];
    }

    protected function getTableActions(): array
    {
        return [
            Actions\TransferAction::make(),
            Actions\RetractAction::make(),
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

    protected function getTableReorderColumn(): ?string
    {
        return 'sortable_order';
    }
}
