<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\Tables\Actions;

use Filament\Forms;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Kumi\Senzou\Events\RequestNote\Committed;
use Kumi\Senzou\Models\Item;
use Kumi\Senzou\Models\RequestNoteApproveItem;
use Kumi\Senzou\Support\Enums\RequestNoteItemStatus;

class ApproveRequestNoteItemAction extends Action
{
    protected string|\Closure|null $modalWidth = 'sm';

    public function setUp(): void
    {
        $this->color('success');

        $this->icon('heroicon-s-check');

        $this->label(__('senzou::filament/resources/request-note-item.columns.approved.label'));

        $this->visible(function (Model $record) {
            return ! $record->isCommitted();
        });

        $this->form([
            Forms\Components\Select::make('item_id')
                ->label('Item')
                ->getSearchResultsUsing(function (string $query) {
                    return Item::query()
                        ->whereLike('name', $query)
                        ->pluck('name', 'id')
                    ;
                })
                ->searchable(),
            Forms\Components\TextInput::make('quantity')
                ->label('Quantity')
                ->default(function (Model $record) {
                    return $record->quantity;
                }),
        ]);

        $this->action(function (Model $record, array $data) {
            $record->update([
                'committed_at' => Carbon::now(),
                'status' => RequestNoteItemStatus::APPROVED,
            ]);

            $attributes = Arr::only($record->toArray(), [
                'request_note_id',
                'stock_on_vessel',
                'reason',
            ]);

            $attributes = array_merge($attributes, $data);

            RequestNoteApproveItem::query()
                ->create($attributes)
            ;

            Committed::dispatch($record);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'approved';
    }
}
