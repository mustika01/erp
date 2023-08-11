<?php

namespace Kumi\Senzou\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Kumi\Senzou\Filament\Resources\RequestNoteResource\Pages;
use Kumi\Senzou\Filament\Resources\RequestNoteResource\RelationManagers\RequestNoteApprovedItemsRelationManager;
use Kumi\Senzou\Filament\Resources\RequestNoteResource\RelationManagers\RequestNoteItemsRelationManager;
use Kumi\Senzou\Filament\Resources\RequestNoteResource\Tables\Actions as TableActions;
use Kumi\Senzou\Models\RequestNote;
use Kumi\Senzou\Support\Enums\RequestNoteStatus;
use Kumi\Sousa\Models\Vessel;

class RequestNoteResource extends Resource
{
    protected static ?string $model = RequestNote::class;

    protected static ?string $navigationGroup = 'senzou';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 4002;

    protected static ?string $slug = 'senzou/request-notes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Placeholder::make('user.vessel.name')
                                    ->label(__('senzou::filament/resources/request-note.fields.vessel.label'))
                                    ->content(function (Model $record) {
                                        return $record->user->vessel->name;
                                    }),
                                Forms\Components\Placeholder::make('created_at')
                                    ->label(__('senzou::filament/resources/request-note.fields.date.label'))
                                    ->content(function (Model $record) {
                                        return $record->created_at->format('d F Y');
                                    }),
                                Forms\Components\Placeholder::make('delivery_requirement')
                                    ->label(__('senzou::filament/resources/request-note.fields.delivery_requirement.label'))
                                    ->content(function (Model $record) {
                                        return $record->delivery_requirement;
                                    }),
                                Forms\Components\Placeholder::make('voyage_number')
                                    ->label(__('senzou::filament/resources/request-note.fields.voyage_number.label'))
                                    ->content(function (Model $record) {
                                        return $record->voyage_number;
                                    }),
                                Forms\Components\Placeholder::make('remarks')
                                    ->label(__('senzou::filament/resources/request-note.fields.remarks.label'))
                                    ->content(function (Model $record) {
                                        return $record->remarks;
                                    }),
                                Forms\Components\Placeholder::make('status')
                                    ->label(__('senzou::filament/resources/request-note.fields.status.label'))
                                    ->content(function (Model $record) {
                                        return $record->status;
                                    }),
                            ]),
                    ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('senzou::filament/resources/request-note.columns.id.label')),
                Tables\Columns\TextColumn::make('user.vessel.name')
                    ->label(__('senzou::filament/resources/request-note.columns.vessel.label')),
                Tables\Columns\TextColumn::make('voyage_number')
                    ->label(__('senzou::filament/resources/request-note.columns.voyage_number.label')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('senzou::filament/resources/request-note.columns.date.label'))
                    ->date('d F Y'),
                Tables\Columns\TextColumn::make('delivery_requirement')
                    ->label(__('senzou::filament/resources/request-note.columns.delivery_requirement.label')),
                Tables\Columns\TextColumn::make('remarks')
                    ->label(__('senzou::filament/resources/request-note.columns.remarks.label')),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('senzou::filament/resources/request-note.columns.status.label'))
                    ->enum([
                        RequestNoteStatus::PENDING => __('senzou::filament/resources/request-note.columns.status.options.' . RequestNoteStatus::PENDING),
                        RequestNoteStatus::APPROVED => __('senzou::filament/resources/request-note.columns.status.options.' . RequestNoteStatus::APPROVED),
                        RequestNoteStatus::REJECTED => __('senzou::filament/resources/request-note.columns.status.options.' . RequestNoteStatus::REJECTED),
                        RequestNoteStatus::IN_REVIEW => __('senzou::filament/resources/request-note.columns.status.options.' . RequestNoteStatus::IN_REVIEW),
                        RequestNoteStatus::FINALIZED => __('senzou::filament/resources/request-note.columns.status.options.' . RequestNoteStatus::FINALIZED),
                        RequestNoteStatus::DENIED => __('senzou::filament/resources/request-note.columns.status.options.' . RequestNoteStatus::DENIED),
                    ])
                    ->colors([
                        'secondary' => fn (string $state) => $state === RequestNoteStatus::PENDING || $state === RequestNoteStatus::IN_REVIEW,
                        'success' => fn (string $state) => $state === RequestNoteStatus::APPROVED,
                        'danger' => fn (string $state) => $state === RequestNoteStatus::REJECTED || $state === RequestNoteStatus::DENIED,
                        'primary' => fn (string $state) => $state === RequestNoteStatus::FINALIZED,
                    ]),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('vessel')
                    ->label(__('senzou::filament/resources/request-note.filters.vessel.label'))
                    ->options(self::getVesselOptions())
                    ->query(function (Builder $query, array $data): Builder {
                        $vesselID = $data['value'];

                        return $vesselID
                            ? $query->byVessel($vesselID)
                            : $query;
                    }),
            ])
            ->actions([
                TableActions\PreviewRequestNoteAction::make(),
                TableActions\DownloadRequestNoteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            RequestNoteItemsRelationManager::class,
            RequestNoteApprovedItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequestNotes::route('/'),
            'view' => Pages\ViewRequestNote::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->status([
            RequestNoteStatus::APPROVED,
            RequestNoteStatus::REJECTED,
            RequestNoteStatus::IN_REVIEW,
            RequestNoteStatus::FINALIZED,
            RequestNoteStatus::DENIED,
        ]);
    }

    protected static function getVesselOptions(): array
    {
        return Vessel::operational()->get()
            ->pluck('name', 'id')
            ->toArray()
        ;
    }
}
