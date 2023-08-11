<?php

namespace Kumi\Jinzai\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Kumi\Jinzai\Filament\Resources\ContractResource\Pages;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Employment;
use Kumi\Jinzai\Support\Enums\EmploymentStatus;

class ContractResource extends Resource
{
    protected static ?string $model = Employment::class;

    protected static ?string $modelLabel = 'Contract';

    protected static ?string $navigationGroup = 'jinzai';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2002;

    protected static ?string $slug = 'jinzai/contracts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->heading(__('jinzai::filament/resources/contract.sections.employee-data'))
                    ->schema([
                        Forms\Components\Group::make([
                            Forms\Components\Select::make('employee_id')
                                ->label(__('jinzai::filament/resources/payroll.fields.employee.label'))
                                ->searchable()
                                ->default(function (Request $request) {
                                    $contract = Employment::query()->firstWhere('employee_id', $request->get('employee_id'));

                                    return $contract ? null : $request->get('employee_id');
                                })
                                ->getSearchResultsUsing(function (string $search) {
                                    return Employee::query()
                                        ->doesntHave('latestInactiveEmployment')
                                        ->whereHas('user', function (Builder $builder) use ($search) {
                                            $builder->where('name', 'ilike', "%{$search}%");
                                        })
                                        ->limit(10)
                                        ->get()
                                        ->pluck('user.name', 'id')
                                    ;
                                })
                                ->getOptionLabelUsing(function (string $value): ?string {
                                    return Employee::find($value)?->user?->name;
                                })
                                ->required()
                                ->disabledOn(['edit']),
                            Forms\Components\Select::make('department_id')
                                ->relationship('department', 'name')
                                ->label(__('jinzai::filament/resources/contract.fields.department.label'))
                                ->searchable()
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(function (\Closure $set) {
                                    $set('job_position_id', null);
                                }),
                            Forms\Components\Select::make('job_position_id')
                                ->label(__('jinzai::filament/resources/contract.fields.job_position.label'))
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
                                ->label(__('jinzai::filament/resources/contract.fields.status.label'))
                                ->options(self::getEmploymentStatusOptions())
                                ->required(),
                        ])->columns(2),
                    ]),
                Forms\Components\Section::make('')
                    ->heading(__('jinzai::filament/resources/contract.sections.contract-details'))
                    ->schema([
                        Forms\Components\Group::make([
                            Forms\Components\DatePicker::make('contract_started_at')
                                ->label(__('jinzai::filament/resources/contract.fields.contract_started_at.label'))
                                ->displayFormat('d F Y')
                                ->closeOnDateSelection(),
                            Forms\Components\DatePicker::make('contract_ended_at')
                                ->label(__('jinzai::filament/resources/contract.fields.contract_ended_at.label'))
                                ->displayFormat('d F Y')
                                ->closeOnDateSelection(),
                            Forms\Components\DatePicker::make('joined_at')
                                ->label(__('jinzai::filament/resources/contract.fields.joined_at.label'))
                                ->displayFormat('d F Y')
                                ->closeOnDateSelection()
                                ->required(),
                            Forms\Components\DatePicker::make('left_at')
                                ->label(__('jinzai::filament/resources/contract.fields.left_at.label'))
                                ->displayFormat('d F Y')
                                ->closeOnDateSelection(),
                            Forms\Components\DatePicker::make('resigned_at')
                                ->label(__('jinzai::filament/resources/contract.fields.resigned_at.label'))
                                ->displayFormat('d F Y')
                                ->closeOnDateSelection(),
                            Forms\Components\Textarea::make('remarks')
                                ->label(__('jinzai::filament/resources/contract.fields.remarks.label')),
                        ])->columns(2),
                    ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department.name')
                    ->label(__('jinzai::filament/resources/contract.columns.department.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('employee.user.name')
                    ->label(__('jinzai::filament/resources/contract.columns.name.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('position.name')
                    ->label(__('jinzai::filament/resources/contract.columns.position.label')),
                Tables\Columns\TextColumn::make('joined_at')
                    ->label(__('jinzai::filament/resources/contract.columns.joined_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    }),
                Tables\Columns\TextColumn::make('contract_started_at')
                    ->label(__('jinzai::filament/resources/contract.columns.contract_started_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('contract_ended_at')
                    ->label(__('jinzai::filament/resources/contract.columns.contract_ended_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    }),
                Tables\Columns\TextColumn::make('left_at')
                    ->label(__('jinzai::filament/resources/contract.columns.left_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('resigned_at')
                    ->label(__('jinzai::filament/resources/contract.columns.resigned_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('jinzai::filament/resources/contract.columns.status.label'))
                    ->enum([
                        EmploymentStatus::PERMANENT => __('jinzai::filament/resources/contract.columns.status.options.' . EmploymentStatus::PERMANENT),
                        EmploymentStatus::CONTRACT => __('jinzai::filament/resources/contract.columns.status.options.' . EmploymentStatus::CONTRACT),
                        EmploymentStatus::PROBATION => __('jinzai::filament/resources/contract.columns.status.options.' . EmploymentStatus::PROBATION),
                    ]),
            ])
            ->filters([
                SelectFilter::make('department')
                    ->label(__('jinzai::filament/resources/employee.filters.department.label'))
                    ->options(self::getDepartmentOptions())
                    ->query(function (Builder $query, array $data): Builder {
                        $department = $data['value'];

                        return $department
                            ? $query->byDepartment($department)
                            : $query;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('contract_started_at')
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
            'index' => Pages\ListContracts::route('/'),
            'create' => Pages\CreateContract::route('/create'),
            'view' => Pages\ViewContract::route('/{record}'),
            'edit' => Pages\EditContract::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $IDs = parent::getEloquentQuery()
            ->selectRaw('distinct employee_id, max(id) as id')
            ->groupBy([
                'employee_id',
            ])
            ->pluck('id')
        ;

        return parent::getEloquentQuery()
            ->whereIn('id', $IDs)
        ;
    }

    protected static function getDepartmentOptions(): array
    {
        return Department::all()
            ->mapWithKeys(function (Department $department) {
                return [$department->id => $department->name];
            })->toArray()
        ;
    }

    protected static function getEmploymentStatusOptions(): array
    {
        return [
            EmploymentStatus::PERMANENT => __('jinzai::filament/resources/contract.fields.status.options.' . EmploymentStatus::PERMANENT),
            EmploymentStatus::CONTRACT => __('jinzai::filament/resources/contract.fields.status.options.' . EmploymentStatus::CONTRACT),
            EmploymentStatus::PROBATION => __('jinzai::filament/resources/contract.fields.status.options.' . EmploymentStatus::PROBATION),
        ];
    }
}
