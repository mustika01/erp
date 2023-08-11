<?php

namespace Kumi\Norikumi\Filament\Resources\CrewResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Kumi\Norikumi\Filament\Resources\CrewResource\RelationManagers\ContractsRelationManager\Tables\Actions as TableActions;
use Kumi\Norikumi\Support\Enums\Position;

class ContractsRelationManager extends RelationManager
{
    protected static string $relationship = 'contracts';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('position')
                    ->label(__('norikumi::filament/resources/contract.fields.position.label'))
                    ->options(self::getPositionOptions())
                    ->required(),
                Forms\Components\Select::make('grade')
                    ->label(__('norikumi::filament/resources/contract.fields.grade.label'))
                    ->options([
                        1 => 'I',
                        2 => 'II',
                        3 => 'III',
                        4 => 'IV',
                        5 => 'V',
                    ])
                    ->nullable(),
                Forms\Components\DatePicker::make('started_at')
                    ->label(__('norikumi::filament/resources/contract.fields.started_at.label'))
                    ->displayFormat('d F Y')
                    ->closeOnDateSelection()
                    ->required(),
                Forms\Components\DatePicker::make('ended_at')
                    ->label(__('norikumi::filament/resources/contract.fields.ended_at.label'))
                    ->displayFormat('d F Y')
                    ->closeOnDateSelection()
                    ->nullable(),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position')
                    ->label(__('norikumi::filament/resources/contract.columns.position.label'))
                    ->formatStateUsing(function (string $state) {
                        return __('norikumi::filament/resources/contract.columns.position.options.' . $state);
                    }),
                Tables\Columns\TextColumn::make('grade')
                    ->label(__('norikumi::filament/resources/contract.columns.grade.label'))
                    ->formatStateUsing(function (?string $state) {
                        return match ($state) {
                            1 => 'I',
                            2 => 'II',
                            3 => 'III',
                            4 => 'IV',
                            5 => 'V',
                            default => 'N/A',
                        };
                    }),
                Tables\Columns\TextColumn::make('started_at_formatted')
                    ->label(__('norikumi::filament/resources/contract.columns.started_at_formatted.label')),
                Tables\Columns\TextColumn::make('ended_at_formatted')
                    ->label(__('norikumi::filament/resources/contract.columns.ended_at_formatted.label')),
                Tables\Columns\TextColumn::make('duration')
                    ->label(__('norikumi::filament/resources/contract.columns.duration.label'))
                    ->getStateUsing(function (Model $record) {
                        $year = $record->started_at->diffInYears($record->ended_at);
                        $month = $record->started_at->diffInMonths($record->ended_at) % 12;

                        $result = '';

                        if ($year > 0) {
                            $result = $result . "{$year} Years ";
                        }

                        if ($month > 0) {
                            $result = $result . "{$month} Months";
                        }

                        return $result;
                    }),
            ])
            ->filters([
            ])
            ->headerActions([
                TableActions\CreateAction::make(),
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

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected static function getPositionOptions(): array
    {
        return [
            Position::NAHKODA => __('norikumi::filament/resources/contract.fields.position.options.' . Position::NAHKODA),
            Position::MUALIM => __('norikumi::filament/resources/contract.fields.position.options.' . Position::MUALIM),
            Position::KKM => __('norikumi::filament/resources/contract.fields.position.options.' . Position::KKM),
            Position::MASINIS => __('norikumi::filament/resources/contract.fields.position.options.' . Position::MASINIS),
            Position::BOSUN => __('norikumi::filament/resources/contract.fields.position.options.' . Position::BOSUN),
            Position::KELASI => __('norikumi::filament/resources/contract.fields.position.options.' . Position::KELASI),
            Position::MANDOR => __('norikumi::filament/resources/contract.fields.position.options.' . Position::MANDOR),
            Position::JURU_MUDI => __('norikumi::filament/resources/contract.fields.position.options.' . Position::JURU_MUDI),
            Position::JURU_MINYAK => __('norikumi::filament/resources/contract.fields.position.options.' . Position::JURU_MINYAK),
            Position::JURU_MASAK => __('norikumi::filament/resources/contract.fields.position.options.' . Position::JURU_MASAK),
            Position::CADET_DECK => __('norikumi::filament/resources/contract.fields.position.options.' . Position::CADET_DECK),
            Position::CADET_ENGINE => __('norikumi::filament/resources/contract.fields.position.options.' . Position::CADET_ENGINE),
            Position::WIPER => __('norikumi::filament/resources/contract.fields.position.options.' . Position::WIPER),
            Position::CRANE_OPERATOR => __('norikumi::filament/resources/contract.fields.position.options.' . Position::CRANE_OPERATOR),
            Position::MESS_BOY => __('norikumi::filament/resources/contract.fields.position.options.' . Position::MESS_BOY),
        ];
    }
}
