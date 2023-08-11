<?php

namespace Kumi\Senzou\Filament\Tables;

use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Senzou\Models\DeliveryNoteEntry;
use Livewire\Component;

class DeliveryNoteEntriesDailyReportTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $date;

    protected $queryString = ['date'];

    public function render(): View
    {
        return view('senzou::filament.tables.delivery-note-entries-daily-report');
    }

    protected function getTableQuery(): Builder
    {
        $date = $this->date
            ? Carbon::parse($this->date)
            : Carbon::now();

        return DeliveryNoteEntry::query()
            ->whereHas('note', function (Builder $query) use ($date) {
                $query->whereDate('date', [$date]);
            })
            ->oldest()
        ;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('item.name')
                ->label(__('senzou::filament/resources/delivery-note.columns.item.label')),
            Tables\Columns\TextColumn::make('quantity')
                ->label(__('senzou::filament/resources/delivery-note.columns.quantity.label'))
                ->formatStateUsing(function (string $state, Model $record) {
                    return "{$state} {$record->item->measurement_symbol}";
                }),
            Tables\Columns\BadgeColumn::make('note.status')
                ->label(__('senzou::filament/resources/delivery-note.columns.status.label'))
                ->formatStateUsing(function (Model $record) {
                    return $record->note->isCommitted()
                        ? __('senzou::filament/resources/delivery-note.columns.status.states.committed')
                        : __('senzou::filament/resources/delivery-note.columns.status.states.draft');
                })
                ->colors(function (Model $record) {
                    return [
                        'secondary',
                        'success' => function () use ($record): bool {
                            return $record->note->isCommitted();
                        },
                    ];
                }),
            Tables\Columns\TextColumn::make('note.vessel.name')
                ->label(__('senzou::filament/resources/delivery-note.columns.vessel.label')),
            Tables\Columns\TextColumn::make('remarks')
                ->label(__('senzou::filament/resources/delivery-note.columns.remarks.label'))
                ->formatStateUsing(function (string $state) {
                    return __('senzou::filament/resources/delivery-note.columns.remarks.options.' . $state);
                }),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
