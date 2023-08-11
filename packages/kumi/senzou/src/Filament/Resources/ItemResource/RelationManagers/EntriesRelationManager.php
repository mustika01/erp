<?php

namespace Kumi\Senzou\Filament\Resources\ItemResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Sousa\Models\Vessel;

class EntriesRelationManager extends RelationManager
{
    protected static string $relationship = 'entries';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('note.vessel.name')
                    ->label(__('senzou::filament/resources/item.relations.vessel.label')),
                Tables\Columns\TextColumn::make('note.id')
                    ->label(__('senzou::filament/resources/item.relations.delivery_note.label')),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(__('senzou::filament/resources/item.relations.quantity.label')),
            ])
            ->filters([
                SelectFilter::make('vessel')
                    ->label(__('senzou::filament/resources/item.filters.vessel.label'))
                    ->options(self::getVesselOptions())
                    ->query(function (Builder $query, array $data): Builder {
                        $vessel = $data['value'];

                        return $vessel
                            ? $query->byVessel($vessel)
                            : $query;
                    }),
            ])
            ->headerActions([
            ])
            ->actions([
            ])
            ->bulkActions([
            ])
        ;
    }

    protected static function getVesselOptions(): array
    {
        return Vessel::query()
            ->operational()
            ->get()
            ->mapWithKeys(function (Vessel $vessel) {
                return [$vessel->id => $vessel->name];
            })->toArray();
    }
}
