<?php

namespace Kumi\Jinzai\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Illuminate\Http\Request;
use Filament\Resources\Table;
use Kumi\Jinzai\Models\Payroll;
use Filament\Resources\Resource;
use Kumi\Jinzai\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Jinzai\Support\Enums\LoanStatus;
use Kumi\Jinzai\Support\Enums\SalaryType;
use Kumi\Jinzai\Support\DefaultPermissions;
use Kumi\Jinzai\Support\Enums\CoveringEntity;
use Kumi\Jinzai\Support\Enums\ActivationStatus;
use Kumi\Jinzai\Support\Enums\NonTaxableIncomeStatus;
use Kumi\Jinzai\Filament\Resources\PayrollResource\Pages;
use Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers;
use Kumi\Jinzai\Filament\Resources\PayrollResource\Tables\Actions as TableActions;

class PayrollResource extends Resource
{
    protected static ?string $model = Payroll::class;

    protected static ?string $navigationGroup = 'jinzai';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2003;

    protected static ?string $slug = 'jinzai/payrolls';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('employee_id')
                                    ->label(__('jinzai::filament/resources/payroll.fields.employee.label'))
                                    ->searchable()
                                    ->default(function (Request $request) {
                                        $payroll = Payroll::query()->firstWhere('employee_id', $request->get('employee_id'));

                                        return $payroll ? null : $request->get('employee_id');
                                    })
                                    ->getSearchResultsUsing(function (string $search) {
                                        return Employee::query()
                                            ->doesntHave('payroll')
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
                                    ->columnSpan(2)
                                    ->disabledOn(['edit']),
                            ]),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('tax_number')
                                    ->label(__('jinzai::filament/resources/payroll.fields.tax_number.label'))
                                    ->mask(
                                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                                            ->numeric()
                                            ->pattern('00.000.000.0-000.000')
                                    ),
                                Forms\Components\Select::make('non_taxable_income_status')
                                    ->label(__('jinzai::filament/resources/payroll.fields.non_taxable_income_status.label'))
                                    ->options([
                                        NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT => __('jinzai::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT),
                                        NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT => __('jinzai::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT),
                                        NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS => __('jinzai::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS),
                                        NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS => __('jinzai::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS),
                                        NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT => __('jinzai::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT),
                                        NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT => __('jinzai::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT),
                                        NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS => __('jinzai::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS),
                                        NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS => __('jinzai::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS),
                                    ])
                                    ->required(),
                            ]),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('social_security_number')
                                    ->label(__('jinzai::filament/resources/payroll.fields.social_security_number.label')),
                            ]),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('health_care_number')
                                    ->label(__('jinzai::filament/resources/payroll.fields.health_care_number.label')),
                                Forms\Components\Select::make('health_care_family_count')
                                    ->label(__('jinzai::filament/resources/payroll.fields.health_care_family_count.label'))
                                    ->options(range(0, 10)),
                                Forms\Components\Select::make('health_care_covering_entity')
                                    ->label(__('jinzai::filament/resources/payroll.fields.health_care_covering_entity.label'))
                                    ->options([
                                        CoveringEntity::COMPANY => __('jinzai::filament/resources/payroll.fields.health_care_covering_entity.options.' . CoveringEntity::COMPANY),
                                        CoveringEntity::EMPLOYEE => __('jinzai::filament/resources/payroll.fields.health_care_covering_entity.options.' . CoveringEntity::EMPLOYEE),
                                    ]),
                            ]),
                    ])->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('salary')
                            ->label(__('jinzai::filament/resources/payroll.fields.salary.label'))
                            ->prefix('IDR')
                            ->required()
                            ->extraInputAttributes(['class' => 'text-right'])
                            ->mask(
                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                    ->numeric()
                                    ->decimalPlaces(0) // Set the number of digits after the decimal point.
                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                    ->integer() // Disallow decimal numbers.
                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                    ->minValue(0) // Set the minimum value that the number can be.
                                    ->maxValue(1_000_000_000) // Set the maximum value that the number can be.
                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                    ->thousandsSeparator(','), // Add a separator for thousands.
                            ),
                        Forms\Components\TextInput::make('job_allowance')
                            ->label(__('jinzai::filament/resources/payroll.fields.job_allowance.label'))
                            ->prefix('IDR')
                            ->required()
                            ->extraInputAttributes(['class' => 'text-right'])
                            ->mask(
                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                    ->numeric()
                                    ->decimalPlaces(0) // Set the number of digits after the decimal point.
                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                    ->integer() // Disallow decimal numbers.
                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                    ->minValue(0) // Set the minimum value that the number can be.
                                    ->maxValue(1_000_000_000) // Set the maximum value that the number can be.
                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                    ->thousandsSeparator(','), // Add a separator for thousands.
                            ),
                        Forms\Components\Select::make('salary_type')
                            ->label(__('jinzai::filament/resources/payroll.fields.salary_type.label'))
                            ->options([
                                SalaryType::MONTHLY => __('jinzai::filament/resources/payroll.fields.salary_type.options.' . SalaryType::MONTHLY),
                                SalaryType::WEEKLY => __('jinzai::filament/resources/payroll.fields.salary_type.options.' . SalaryType::WEEKLY),
                                SalaryType::DAILY => __('jinzai::filament/resources/payroll.fields.salary_type.options.' . SalaryType::DAILY),
                            ])
                            ->default(SalaryType::MONTHLY)
                            ->required(),
                        Forms\Components\TextInput::make('salary_grade')
                            ->label(__('jinzai::filament/resources/payroll.fields.salary_grade.label'))
                            ->required(),
                    ])->visible(function () {
                        return Auth::user()->can(DefaultPermissions::MANAGE_PAYROLL_SALARY_DATA);
                    })->columnSpan(1),
            ])
            ->columns(3)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.internal_id')
                    ->label(__('jinzai::filament/resources/payroll.columns.internal_id.label'))
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('employee.user.name')
                    ->label(__('jinzai::filament/resources/payroll.columns.name.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('tax_number')
                    ->label(__('jinzai::filament/resources/payroll.columns.tax_number.label'))
                    ->toggleable()
                    ->extraAttributes(['class' => 'font-mono'])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('non_taxable_income_status')
                    ->label(__('jinzai::filament/resources/payroll.columns.non_taxable_income_status.label'))
                    ->enum([
                        NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT => __('jinzai::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT),
                        NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT => __('jinzai::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT),
                        NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS => __('jinzai::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS),
                        NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS => __('jinzai::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS),
                        NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT => __('jinzai::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT),
                        NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT => __('jinzai::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT),
                        NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS => __('jinzai::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS),
                        NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS => __('jinzai::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS),
                    ])
                    ->extraAttributes(['class' => 'font-mono'])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('social_security_number')
                    ->label(__('jinzai::filament/resources/payroll.columns.social_security_number.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('health_care_number')
                    ->label(__('jinzai::filament/resources/payroll.columns.health_care_number.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('health_care_family_count')
                    ->label(__('jinzai::filament/resources/payroll.columns.health_care_family_count.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('health_care_covering_entity')
                    ->label(__('jinzai::filament/resources/payroll.columns.health_care_covering_entity.label'))
                    ->enum([
                        CoveringEntity::COMPANY => __('jinzai::filament/resources/payroll.columns.health_care_covering_entity.options.' . CoveringEntity::COMPANY),
                        CoveringEntity::EMPLOYEE => __('jinzai::filament/resources/payroll.columns.health_care_covering_entity.options.' . CoveringEntity::EMPLOYEE),
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('salary')
                    ->label(__('jinzai::filament/resources/payroll.columns.salary.label'))
                    ->formatStateUsing(function (?string $state) {
                        return is_null($state) ? null : number_format($state);
                    })
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono'])
                    ->visible(function () {
                        return Auth::user()->can(DefaultPermissions::MANAGE_PAYROLL_SALARY_DATA);
                    }),
                Tables\Columns\TextColumn::make('job_allowance')
                    ->label(__('jinzai::filament/resources/payroll.columns.job_allowance.label'))
                    ->formatStateUsing(function (?string $state) {
                        return is_null($state) ? null : number_format($state);
                    })
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono'])
                    ->visible(function () {
                        return Auth::user()->can(DefaultPermissions::MANAGE_PAYROLL_SALARY_DATA);
                    }),
                Tables\Columns\TextColumn::make('salary_type')
                    ->label(__('jinzai::filament/resources/payroll.columns.salary_type.label'))
                    ->enum([
                        SalaryType::MONTHLY => __('jinzai::filament/resources/payroll.columns.salary_type.options.' . SalaryType::MONTHLY),
                        SalaryType::WEEKLY => __('jinzai::filament/resources/payroll.columns.salary_type.options.' . SalaryType::WEEKLY),
                        SalaryType::DAILY => __('jinzai::filament/resources/payroll.columns.salary_type.options.' . SalaryType::DAILY),
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BooleanColumn::make('is_activated')
                    ->label(__('jinzai::filament/resources/payroll.columns.is_activated.label'))
                    ->getStateUsing(function (Model $record) {
                        return $record->isActivated();
                    }),
            ])
            ->filters([
                SelectFilter::make('activation_status')
                    ->label(__('jinzai::filament/resources/payroll/filters/activation-status.title'))
                    ->options([
                        ActivationStatus::ACTIVATED => __('jinzai::filament/resources/payroll/filters/activation-status.options.' . ActivationStatus::ACTIVATED),
                        ActivationStatus::NOT_ACTIVATED => __('jinzai::filament/resources/payroll/filters/activation-status.options.' . ActivationStatus::NOT_ACTIVATED),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (empty($data['value'])) {
                            return $query;
                        }

                        return $data['value'] === ActivationStatus::ACTIVATED
                            ? $query->whereNotNull('activated_at')
                            : $query->whereNull('activated_at');
                    }),
                SelectFilter::make('loan_status')
                    ->label(__('jinzai::filament/resources/payroll/filters/loan-status.title'))
                    ->options([
                        LoanStatus::PENDING => __('jinzai::filament/resources/payroll/filters/loan-status.options.' . LoanStatus::PENDING),
                        LoanStatus::APPROVED => __('jinzai::filament/resources/payroll/filters/loan-status.options.' . LoanStatus::APPROVED),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (empty($data['value'])) {
                            return $query;
                        }

                        return $data['value'] === LoanStatus::PENDING
                            ? $query->whereHas('loans', fn (Builder $builder) => $builder->doesntHave('approval'))
                            : $query->whereHas('loans', fn (Builder $builder) => $builder->has('approval'));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                TableActions\ActivateBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BanksRelationManager::class,
            RelationManagers\PayoutsRelationManager::class,
            RelationManagers\LoansRelationManager::class,
            RelationManagers\ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayrolls::route('/'),
            'create' => Pages\CreatePayroll::route('/create'),
            'view' => Pages\ViewPayroll::route('/{record}'),
            'edit' => Pages\EditPayroll::route('/{record}/edit'),
        ];
    }
}
