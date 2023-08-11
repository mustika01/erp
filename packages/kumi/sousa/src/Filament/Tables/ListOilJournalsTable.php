<?php

namespace Kumi\Sousa\Filament\Tables;

use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Sousa\Filament\Resources\OilJournalResource;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Tables\Actions as TableActions;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Traits\InteractsWithOilJournalSchema;
use Kumi\Sousa\Models\Bunker;
use Livewire\Component;

class ListOilJournalsTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use InteractsWithOilJournalSchema;

    public Bunker $bunker;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    public function render(): View
    {
        return view('sousa::filament.tables.list-oil-journals');
    }

    protected function getTableQuery(): Builder
    {
        $this->emit('filterPeriod', [
            'year' => $this->tableFilters['period']['year'] ?? Carbon::now()->format('Y'),
            'month' => $this->tableFilters['period']['month'] ?? Carbon::now()->format('m'),
        ]);

        return $this->bunker->oils()->getQuery()->latest('date');
    }

    protected function getTableColumns(): array
    {
        return static::getSchemaForTableColumns(false);
    }

    protected function getTableFilters(): array
    {
        return static::getSchemaForTableFilters(false);
    }

    protected function getTableActions(): array
    {
        return [
            TableActions\CommitAction::make(),
            Tables\Actions\ViewAction::make()
                ->url(function (Model $record) {
                    return OilJournalResource::getUrl('view', ['record' => $record]);
                })
                ->authorize(function (Model $record) {
                    return OilJournalResource::canView($record);
                }),
            Tables\Actions\EditAction::make()
                ->url(function (Model $record) {
                    return OilJournalResource::getUrl('edit', ['record' => $record]);
                })
                ->authorize(function (Model $record) {
                    return OilJournalResource::canEdit($record);
                }),
            Tables\Actions\DeleteAction::make()
                ->authorize(function (Model $record) {
                    return OilJournalResource::canDelete($record);
                }),
        ];
    }
}
