<?php

namespace Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Carbon;
use Kumi\Jinzai\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\Enums\EmploymentStatus;
use Filament\Resources\RelationManagers\RelationManager;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers\EmploymentsRelationManager\Actions as RelationManagerActions;

class EmploymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'employments';

    protected static ?string $recordTitleAttribute = 'employee.name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\Select::make('department_id')
                        ->relationship('department', 'name')
                        ->label(__('jinzai::filament/resources/employment.fields.department.label'))
                        ->reactive()
                        ->required()
                        ->afterStateUpdated(function (\Closure $set) {
                            $set('job_position_id', null);
                        }),
                    Forms\Components\Select::make('job_position_id')
                        ->label(__('jinzai::filament/resources/employment.fields.job_position.label'))
                        ->options(function (\Closure $get) {
                            $department = Department::query()->find($get('department_id'));

                            if (! $department) {
                                return [];
                            }

                            return $department->positions->pluck('name', 'id');
                        })
                        ->disabled(function (\Closure $get) {
                            return $get('department_id') === null;
                        })
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label(__('jinzai::filament/resources/employment.fields.status.label'))
                        ->options(self::getEmploymentStatusOptions())
                        ->required(),
                    Forms\Components\Textarea::make('remarks')
                        ->label(__('jinzai::filament/resources/employment.fields.remarks.label')),
                ]),
                Forms\Components\Group::make([
                    Forms\Components\DatePicker::make('joined_at')
                        ->label(__('jinzai::filament/resources/employment.fields.joined_at.label'))
                        ->displayFormat('d F Y')
                        ->closeOnDateSelection()
                        ->required(),
                    Forms\Components\DatePicker::make('contract_started_at')
                        ->label(__('jinzai::filament/resources/employment.fields.contract_started_at.label'))
                        ->displayFormat('d F Y')
                        ->closeOnDateSelection(),
                    Forms\Components\DatePicker::make('contract_ended_at')
                        ->label(__('jinzai::filament/resources/employment.fields.contract_ended_at.label'))
                        ->displayFormat('d F Y')
                        ->closeOnDateSelection(),
                    Forms\Components\DatePicker::make('left_at')
                        ->label(__('jinzai::filament/resources/employment.fields.left_at.label'))
                        ->displayFormat('d F Y')
                        ->closeOnDateSelection(),
                    Forms\Components\DatePicker::make('resigned_at')
                        ->label(__('jinzai::filament/resources/employment.fields.resigned_at.label'))
                        ->displayFormat('d F Y')
                        ->closeOnDateSelection(),
                ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department.name')
                    ->label(__('jinzai::filament/resources/employment.columns.department.label')),
                Tables\Columns\TextColumn::make('position.name')
                    ->label(__('jinzai::filament/resources/employment.columns.position.label')),
                Tables\Columns\TextColumn::make('joined_at')
                    ->label(__('jinzai::filament/resources/employment.columns.joined_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    }),
                Tables\Columns\TextColumn::make('contract_started_at')
                    ->label(__('jinzai::filament/resources/employment.columns.contract_started_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    }),
                Tables\Columns\TextColumn::make('contract_ended_at')
                    ->label(__('jinzai::filament/resources/employment.columns.contract_ended_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    }),
                Tables\Columns\TextColumn::make('left_at')
                    ->label(__('jinzai::filament/resources/employment.columns.left_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('resigned_at')
                    ->label(__('jinzai::filament/resources/employment.columns.resigned_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('jinzai::filament/resources/employment.columns.status.label'))
                    ->enum([
                        EmploymentStatus::PERMANENT => __('jinzai::filament/resources/employment.columns.status.options.' . EmploymentStatus::PERMANENT),
                        EmploymentStatus::CONTRACT => __('jinzai::filament/resources/employment.columns.status.options.' . EmploymentStatus::CONTRACT),
                        EmploymentStatus::PROBATION => __('jinzai::filament/resources/employment.columns.status.options.' . EmploymentStatus::PROBATION),
                    ]),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->hidden(function (Model $record) {
                        return ! is_null($record->left_at) || ! is_null($record->resigned_at);
                    }),
                Tables\Actions\DeleteAction::make()
                    ->hidden(function (Model $record) {
                        return ! is_null($record->left_at) || ! is_null($record->resigned_at);
                    }),
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

    protected static function getEmploymentStatusOptions(): array
    {
        return [
            EmploymentStatus::PERMANENT => __('jinzai::filament/resources/employment.fields.status.options.' . EmploymentStatus::PERMANENT),
            EmploymentStatus::CONTRACT => __('jinzai::filament/resources/employment.fields.status.options.' . EmploymentStatus::CONTRACT),
            EmploymentStatus::PROBATION => __('jinzai::filament/resources/employment.fields.status.options.' . EmploymentStatus::PROBATION),
        ];
    }
}
