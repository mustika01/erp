<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Kumi\Senzou\Filament\Resources\RequestNoteResource\Tables\Actions as TableActions;
use Kumi\Senzou\Support\Enums\RequestNoteItemStatus;
use Kumi\Senzou\Support\Enums\RequestNoteStatus;

class RequestNoteItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('quantity_approved')
                    ->label('Approve Quantity')
                    ->nullable()
                    ->required(),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('senzou::filament/resources/request-note-item.columns.name.label')),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(__('senzou::filament/resources/request-note-item.columns.quantity.label')),
                Tables\Columns\TextColumn::make('stock_on_vessel')
                    ->label(__('senzou::filament/resources/request-note-item.columns.stock_on_vessel.label')),
                Tables\Columns\TextColumn::make('reason')
                    ->label(__('senzou::filament/resources/request-note-item.columns.reason.label')),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('senzou::filament/resources/request-note.columns.status.label'))
                    ->enum([
                        RequestNoteItemStatus::PENDING => __('senzou::filament/resources/request-note-item.columns.status.options.' . RequestNoteItemStatus::PENDING),
                        RequestNoteItemStatus::APPROVED => __('senzou::filament/resources/request-note-item.columns.status.options.' . RequestNoteItemStatus::APPROVED),
                        RequestNoteItemStatus::REJECTED => __('senzou::filament/resources/request-note-item.columns.status.options.' . RequestNoteItemStatus::REJECTED),
                    ])
                    ->colors([
                        'secondary' => fn (string $state) => $state === RequestNoteItemStatus::PENDING,
                        'success' => fn (string $state) => $state === RequestNoteItemStatus::APPROVED,
                        'danger' => fn (string $state) => $state === RequestNoteItemStatus::REJECTED,
                    ]),
            ])
            ->filters([
            ])
            ->headerActions([
            ])
            ->actions([
                TableActions\ApproveRequestNoteItemAction::make()
                    ->hidden(function (Model $record) {
                        return $record->isCommitted()
                        || $record->note->status === RequestNoteStatus::REJECTED
                        || $record->note->status === RequestNoteStatus::PENDING;
                    }),

                TableActions\RejectRequestNoteItemAction::make()
                    ->hidden(function (Model $record) {
                        return $record->isCommitted()
                        || $record->note->status === RequestNoteStatus::REJECTED
                        || $record->note->status === RequestNoteStatus::PENDING;
                    }),
            ])
            ->bulkActions([
            ])
        ;
    }

    protected function getTableQuery(): Builder|Relation
    {
        return parent::getTableQuery()->oldest('id');
    }
}
