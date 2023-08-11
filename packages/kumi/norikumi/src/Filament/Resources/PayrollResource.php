<?php

namespace Kumi\Norikumi\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Filament\Resources\PayrollResource\Pages;
use Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers;
use Kumi\Norikumi\Filament\Resources\PayrollResource\Tables\Actions as TableActions;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Norikumi\Support\Enums\ActivationStatus;
use Kumi\Norikumi\Support\Enums\CoveringEntity;
use Kumi\Norikumi\Support\Enums\LoanStatus;
use Kumi\Norikumi\Support\Enums\NonTaxableIncomeStatus;
use Kumi\Norikumi\Support\Enums\SalaryType;

class PayrollResource extends Resource
{
    protected static ?string $model = Payroll::class;

    protected static ?string $navigationGroup = 'norikumi';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2103;

    protected static ?string $slug = 'norikumi/payrolls';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('crew_id')
                                    ->label(__('norikumi::filament/resources/payroll.fields.crew.label'))
                                    ->searchable()
                                    ->default(function (Request $request) {
                                        $payroll = Payroll::query()->firstWhere('crew_id', $request->get('crew_id'));

                                        return $payroll ? null : $request->get('crew_id');
                                    })
                                    ->getSearchResultsUsing(function (string $search) {
                                        return Crew::query()
                                            ->doesntHave('payroll')
                                            ->where('name', 'ilike', "%{$search}%")
                                            ->limit(10)
                                            ->get()
                                            ->pluck('name', 'id')
                                        ;
                                    })
                                    ->getOptionLabelUsing(function (string $value): ?string {
                                        return Crew::find($value)?->name;
                                    })
                                    ->required()
                                    ->columnSpan(2)
                                    ->disabledOn(['edit']),
                            ]),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('tax_number')
                                    ->label(__('norikumi::filament/resources/payroll.fields.tax_number.label'))
                                    ->mask(
                                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                                            ->numeric()
                                            ->pattern('00.000.000.0-000.000')
                                    ),
                                Forms\Components\Select::make('non_taxable_income_status')
                                    ->label(__('norikumi::filament/resources/payroll.fields.non_taxable_income_status.label'))
                                    ->options([
                                        NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT => __('norikumi::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT),
                                        NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT => __('norikumi::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT),
                                        NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS => __('norikumi::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS),
                                        NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS => __('norikumi::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS),
                                        NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT => __('norikumi::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT),
                                        NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT => __('norikumi::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT),
                                        NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS => __('norikumi::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS),
                                        NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS => __('norikumi::filament/resources/payroll.fields.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS),
                                    ])
                                    ->required(),
                            ]),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('social_security_number')
                                    ->label(__('norikumi::filament/resources/payroll.fields.social_security_number.label')),
                            ]),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('health_care_number')
                                    ->label(__('norikumi::filament/resources/payroll.fields.health_care_number.label')),
                                Forms\Components\Select::make('health_care_family_count')
                                    ->label(__('norikumi::filament/resources/payroll.fields.health_care_family_count.label'))
                                    ->options(range(0, 10)),
                                Forms\Components\Select::make('health_care_covering_entity')
                                    ->label(__('norikumi::filament/resources/payroll.fields.health_care_covering_entity.label'))
                                    ->options([
                                        CoveringEntity::COMPANY => __('norikumi::filament/resources/payroll.fields.health_care_covering_entity.options.' . CoveringEntity::COMPANY),
                                        CoveringEntity::CREW => __('norikumi::filament/resources/payroll.fields.health_care_covering_entity.options.' . CoveringEntity::CREW),
                                    ]),
                            ]),
                    ])->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('salary')
                            ->label(__('norikumi::filament/resources/payroll.fields.salary.label'))
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
                            ->label(__('norikumi::filament/resources/payroll.fields.salary_type.label'))
                            ->options([
                                SalaryType::MONTHLY => __('norikumi::filament/resources/payroll.fields.salary_type.options.' . SalaryType::MONTHLY),
                                SalaryType::WEEKLY => __('norikumi::filament/resources/payroll.fields.salary_type.options.' . SalaryType::WEEKLY),
                                SalaryType::DAILY => __('norikumi::filament/resources/payroll.fields.salary_type.options.' . SalaryType::DAILY),
                            ])
                            ->default(SalaryType::MONTHLY)
                            ->required(),
                        Forms\Components\TextInput::make('salary_grade')
                            ->label(__('norikumi::filament/resources/payroll.fields.salary_grade.label'))
                            ->required(),
                    ])->visible(function () {
                        return Auth::user()->can(DefaultPermissions::MANAGE_PAYROLL_SALARY_DATA);
                    })
                    ->columnSpan(1),
            ])->columns(3)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('crew.name')
                    ->label(__('norikumi::filament/resources/payroll.columns.name.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('tax_number')
                    ->label(__('norikumi::filament/resources/payroll.columns.tax_number.label'))
                    ->toggleable()
                    ->extraAttributes(['class' => 'font-mono'])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('non_taxable_income_status')
                    ->label(__('norikumi::filament/resources/payroll.columns.non_taxable_income_status.label'))
                    ->enum([
                        NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT => __('norikumi::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT),
                        NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT => __('norikumi::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT),
                        NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS => __('norikumi::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS),
                        NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS => __('norikumi::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS),
                        NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT => __('norikumi::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT),
                        NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT => __('norikumi::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT),
                        NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS => __('norikumi::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS),
                        NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS => __('norikumi::filament/resources/payroll.columns.non_taxable_income_status.options.' . NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS),
                    ])
                    ->extraAttributes(['class' => 'font-mono'])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('social_security_number')
                    ->label(__('norikumi::filament/resources/payroll.columns.social_security_number.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('health_care_number')
                    ->label(__('norikumi::filament/resources/payroll.columns.health_care_number.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('health_care_family_count')
                    ->label(__('norikumi::filament/resources/payroll.columns.health_care_family_count.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('health_care_covering_entity')
                    ->label(__('norikumi::filament/resources/payroll.columns.health_care_covering_entity.label'))
                    ->enum([
                        CoveringEntity::COMPANY => __('norikumi::filament/resources/payroll.columns.health_care_covering_entity.options.' . CoveringEntity::COMPANY),
                        CoveringEntity::CREW => __('norikumi::filament/resources/payroll.columns.health_care_covering_entity.options.' . CoveringEntity::CREW),
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('salary')
                    ->label(__('norikumi::filament/resources/payroll.columns.salary.label'))
                    ->formatStateUsing(function (?string $state) {
                        return is_null($state) ? null : number_format($state);
                    })
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono'])
                    ->visible(function () {
                        return Auth::user()->can(DefaultPermissions::MANAGE_PAYROLL_SALARY_DATA);
                    }),

                Tables\Columns\TextColumn::make('salary_type')
                    ->label(__('norikumi::filament/resources/payroll.columns.salary_type.label'))
                    ->enum([
                        SalaryType::MONTHLY => __('norikumi::filament/resources/payroll.columns.salary_type.options.' . SalaryType::MONTHLY),
                        SalaryType::WEEKLY => __('norikumi::filament/resources/payroll.columns.salary_type.options.' . SalaryType::WEEKLY),
                        SalaryType::DAILY => __('norikumi::filament/resources/payroll.columns.salary_type.options.' . SalaryType::DAILY),
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BooleanColumn::make('is_activated')
                    ->label(__('norikumi::filament/resources/payroll.columns.is_activated.label'))
                    ->getStateUsing(function (Model $record) {
                        return $record->isActivated();
                    }),
            ])
            ->filters([
                SelectFilter::make('activation_status')
                    ->label(__('norikumi::filament/resources/payroll/filters/activation-status.title'))
                    ->options([
                        ActivationStatus::ACTIVATED => __('norikumi::filament/resources/payroll/filters/activation-status.options.' . ActivationStatus::ACTIVATED),
                        ActivationStatus::NOT_ACTIVATED => __('norikumi::filament/resources/payroll/filters/activation-status.options.' . ActivationStatus::NOT_ACTIVATED),
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
                    ->label(__('norikumi::filament/resources/payroll/filters/loan-status.title'))
                    ->options([
                        LoanStatus::PENDING => __('norikumi::filament/resources/payroll/filters/loan-status.options.' . LoanStatus::PENDING),
                        LoanStatus::APPROVED => __('norikumi::filament/resources/payroll/filters/loan-status.options.' . LoanStatus::APPROVED),
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
            RelationManagers\DepositsRelationManager::class,
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
