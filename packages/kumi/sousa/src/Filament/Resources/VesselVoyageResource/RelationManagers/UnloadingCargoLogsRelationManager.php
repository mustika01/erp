<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\RelationManagers;

use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Traits\InteractsWithCargoLogSchema;

class UnloadingCargoLogsRelationManager extends RelationManager
{
    use InteractsWithCargoLogSchema;

    protected static string $relationship = 'unloadingCargoLogs';

    protected static ?string $recordTitleAttribute = 'description';

    protected static ?string $modelLabel = 'unloading log';

    protected static ?string $title = 'Unloading';

    public static function form(Form $form): Form
    {
        return $form->schema(self::getCargoLogSchema(false));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::getCargoLogTableColumns())
            ->filters([

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->disableCreateAnother(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function canViewForRecord(Model $ownerRecord): bool
    {
        return parent::canViewForRecord($ownerRecord) && ! $ownerRecord->is_returning;
    }
}
