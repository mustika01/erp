<?php

namespace Kumi\Sousa\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Kumi\Kanshi\Filament\RelationManagers\ActivitiesRelationManager;
use Kumi\Sousa\Filament\Resources\BunkerResource\Pages;
use Kumi\Sousa\Filament\Resources\BunkerResource\RelationManagers;
use Kumi\Sousa\Filament\Resources\BunkerResource\Tables\Actions;
use Kumi\Sousa\Models\Bunker;

class BunkerResource extends Resource
{
    protected static ?string $model = Bunker::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?int $navigationSort = 3005;

    protected static ?string $slug = 'sousa/bunkers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\Select::make('vessel_id')
                        ->label(__('sousa::filament/resources/bunker.fields.vessel.label'))
                        ->relationship('vessel', 'name')
                        ->preload()
                        ->searchable()
                        ->required(),
                    Forms\Components\TextInput::make('rob_amount')
                        ->label(__('sousa::filament/resources/bunker.fields.rob_amount.label'))
                        ->disabled()
                        ->visible(function (string $context) {
                            return $context === 'view';
                        })
                        ->suffix('ℓ')
                        ->columnSpan('col-start-3'),
                    Forms\Components\Repeater::make('engines')
                        ->label(__('sousa::filament/resources/bunker.fields.engines.label'))
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('label')
                                ->label(__('sousa::filament/resources/bunker-engine.fields.label.label'))
                                ->lazy()
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->label(__('sousa::filament/resources/bunker-engine.fields.description.label'))
                                ->nullable(),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                        ->disableItemDeletion(function (string $context) {
                            return $context === 'edit';
                        })
                        ->grid(3)
                        ->columnSpan(3),
                ])->columns(3),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vessel.name')
                    ->label(__('sousa::filament/resources/bunker.columns.vessel.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('latest_journal_date')
                    ->label(__('sousa::filament/resources/bunker.columns.latest_journal_date.label')),
                Tables\Columns\TextColumn::make('rob_amount_formatted')
                    ->label(__('sousa::filament/resources/bunker.columns.rob_amount_formatted.label')),
                Tables\Columns\TextColumn::make('type_90_amount_formatted')
                    ->label(__('sousa::filament/resources/bunker.columns.type_90_amount_formatted.label')),
                Tables\Columns\TextColumn::make('type_40_amount_formatted')
                    ->label(__('sousa::filament/resources/bunker.columns.type_40_amount_formatted.label')),
                Tables\Columns\TextColumn::make('type_10_amount_formatted')
                    ->label(__('sousa::filament/resources/bunker.columns.type_10_amount_formatted.label')),
                Tables\Columns\IconColumn::make('is_finalized')
                    ->label(__('sousa::filament/resources/bunker.columns.is_finalized.label'))
                    ->boolean(),
            ])
            ->filters([
            ])
            ->actions([
                Actions\SolarAction::make(),
                Actions\OilAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FormulasRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBunkers::route('/'),
            'create' => Pages\CreateBunker::route('/create'),
            'view' => Pages\ViewBunker::route('/{record}'),
            'edit' => Pages\EditBunker::route('/{record}/edit'),
        ];
    }
}
