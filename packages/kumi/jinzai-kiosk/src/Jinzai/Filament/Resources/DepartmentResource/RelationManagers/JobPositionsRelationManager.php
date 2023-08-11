<?php

namespace Kumi\Jinzai\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Facades\Auth;
use Kumi\Jinzai\Support\DefaultPermissions;
use Filament\Resources\RelationManagers\RelationManager;

class JobPositionsRelationManager extends RelationManager
{
    protected static string $relationship = 'positions';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        $canViewLevelField = Auth::user()->can(DefaultPermissions::UPDATE_JOB_POSITION_LEVEL);

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('jinzai::filament/resources/job-position.fields.name.label'))
                    ->required()
                    ->columnSpan($canViewLevelField ? 3 : 4),
                Forms\Components\TextInput::make('level')
                    ->label(__('jinzai::filament/resources/job-position.fields.level.label'))
                    ->mask(
                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                            ->numeric()
                            ->decimalPlaces(0) // Set the number of digits after the decimal point.
                            ->decimalSeparator(',') // Add a separator for decimal numbers.
                            ->integer() // Disallow decimal numbers.
                            ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                            ->minValue(0) // Set the minimum value that the number can be.
                            ->maxValue(10_000) // Set the maximum value that the number can be.
                            ->normalizeZeros() // Append or remove zeros at the end of the number.
                            ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                            ->thousandsSeparator(','), // Add a separator for thousands.
                    )
                    ->visible(function () use ($canViewLevelField) {
                        return $canViewLevelField;
                    }),
                Forms\Components\Textarea::make('description')
                    ->label(__('jinzai::filament/resources/job-position.fields.description.label'))
                    ->columnSpan(4),
            ])
            ->columns(4)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('jinzai::filament/resources/job-position.columns.name.label')),
                Tables\Columns\TextColumn::make('code')
                    ->label(__('jinzai::filament/resources/job-position.columns.code.label')),
                Tables\Columns\BadgeColumn::make('employments_count')
                    ->label(__('jinzai::filament/resources/job-position.columns.employments-count.label'))
                    ->counts('employments')
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\BadgeColumn::make('level')
                    ->label(__('jinzai::filament/resources/job-position.columns.level.label'))
                    ->visible(function () {
                        return Auth::user()->can(DefaultPermissions::VIEW_JOB_POSITION_LEVEL);
                    })
                    ->extraAttributes(['class' => 'font-mono']),
            ])
            ->filters([

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
