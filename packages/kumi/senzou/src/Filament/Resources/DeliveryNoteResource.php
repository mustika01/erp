<?php

namespace Kumi\Senzou\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Pages;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Tables\Actions as TableActions;
use Kumi\Senzou\Models\DeliveryNote;
use Kumi\Senzou\Models\Item;
use Kumi\Senzou\Support\Enums\DeliveryNoteEntryRemarks;

class DeliveryNoteResource extends Resource
{
    protected static ?string $model = DeliveryNote::class;

    protected static ?string $navigationGroup = 'senzou';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 4004;

    protected static ?string $slug = 'senzou/delivery-notes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Select::make('vessel_id')
                                    ->relationship('vessel', 'name')
                                    ->label(__('senzou::filament/resources/delivery-note.fields.vessel.label'))
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                Forms\Components\DatePicker::make('date')
                                    ->label(__('senzou::filament/resources/delivery-note.fields.date.label'))
                                    ->displayFormat('d F Y')
                                    ->default(Carbon::now())
                                    ->required(),
                            ])->columnSpan(1),
                        Forms\Components\Repeater::make('entries')
                            ->relationship('entries')
                            ->disableLabel()
                            ->schema([
                                Forms\Components\Grid::make(5)
                                    ->schema([
                                        Forms\Components\Select::make('item_id')
                                            ->relationship('item', 'name')
                                            ->label(__('senzou::filament/resources/delivery-note.fields.name.label'))
                                            ->searchable()
                                            ->reactive()
                                            ->required()
                                            ->columnSpan(3),
                                        Forms\Components\TextInput::make('quantity')
                                            ->label(__('senzou::filament/resources/delivery-note.fields.quantity.label'))
                                            ->suffix(function (\Closure $get) {
                                                $item = $get('item_id') ? Item::find($get('item_id')) : null;

                                                return $item ? $item->measurement_symbol : null;
                                            })
                                            ->required(),
                                        Forms\Components\Select::make('remarks')
                                            ->label(__('senzou::filament/resources/delivery-note.fields.remarks.label'))
                                            ->options([
                                                DeliveryNoteEntryRemarks::DECK => __('senzou::filament/resources/delivery-note.fields.remarks.options.' . DeliveryNoteEntryRemarks::DECK),
                                                DeliveryNoteEntryRemarks::ENGINE => __('senzou::filament/resources/delivery-note.fields.remarks.options.' . DeliveryNoteEntryRemarks::ENGINE),
                                            ])
                                            ->default(DeliveryNoteEntryRemarks::DECK)
                                            ->required(),
                                    ]),
                            ])
                            ->extraAttributes(['class' => '!mt-0'])
                            ->columnSpan(2),
                    ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label(__('senzou::filament/resources/delivery-note.columns.date.label'))
                    ->formatStateUsing(function (?Carbon $state) {
                        return $state ? $state->format('d F Y') : null;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('vessel.name')
                    ->label(__('senzou::filament/resources/delivery-note.columns.vessel.label'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('senzou::filament/resources/delivery-note.columns.status.label'))
                    ->formatStateUsing(function (Model $record) {
                        return $record->isCommitted()
                            ? __('senzou::filament/resources/delivery-note.columns.status.states.committed')
                            : __('senzou::filament/resources/delivery-note.columns.status.states.draft');
                    })
                    ->colors(function (Model $record) {
                        return [
                            'secondary',
                            'success' => function () use ($record): bool {
                                return $record->isCommitted();
                            },
                        ];
                    }),
            ])
            ->filters([
                SelectFilter::make('vessel')
                    ->relationship('vessel', 'name'),
                Filter::make('period')
                    ->form([
                        Forms\Components\Select::make('year')
                            ->options(function () {
                                $options = Collection::make();

                                $start = Carbon::parse('2023-01-01');

                                while ($start->isBefore(Carbon::now())) {
                                    $options->push($start->format('Y'));
                                    $start->addYear();
                                }

                                return $options->mapWithKeys(function ($value) {
                                    return [$value => $value];
                                });
                            })
                            ->default(Carbon::now()->format('Y'))
                            ->required(),
                        Forms\Components\Select::make('month')
                            ->options(function () {
                                $options = Collection::make();

                                $start = Carbon::parse('2023-01-01');
                                $end = $start->copy()->endOfYear()->endOfMonth()->endOfDay();

                                while ($start->isBefore($end)) {
                                    $options->push([
                                        'id' => $start->format('m'),
                                        'label' => $start->format('F'),
                                    ]);
                                    $start->addMonth();
                                }

                                return $options->mapWithKeys(function ($value) {
                                    return [$value['id'] => $value['label']];
                                });
                            })
                            ->default(Carbon::now()->format('m'))
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->whereMonth('date', $data['month'])
                            ->whereYear('date', $data['year'])
                        ;
                    }),
            ])
            ->actions([
                TableActions\PreviewDeliveryNoteAction::make(),
                TableActions\DownloadDeliveryNoteAction::make(),
                TableActions\CommitAction::make(),

                Tables\Actions\ViewAction::make()
                    ->visible(function (Model $record) {
                        return $record->isCommitted();
                    }),
                Tables\Actions\EditAction::make()
                    ->hidden(function (Model $record) {
                        return $record->isCommitted();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->hidden(function (Model $record) {
                        return $record->isCommitted();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeliveryNotes::route('/'),
            'create' => Pages\CreateDeliveryNote::route('/create'),
            'edit' => Pages\EditDeliveryNote::route('/{record}/edit'),
            'view' => Pages\ViewDeliveryNote::route('/{record}'),
        ];
    }
}
