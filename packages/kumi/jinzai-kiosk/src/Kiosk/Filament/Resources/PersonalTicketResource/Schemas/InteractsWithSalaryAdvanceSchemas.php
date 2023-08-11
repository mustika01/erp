<?php

namespace Kumi\Kiosk\Filament\Resources\PersonalTicketResource\Schemas;

use Closure;
use Filament\Forms;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\TicketCategory;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kiosk\Support\Enums\LoanPeriod;
use Kumi\Kiosk\Actions\CalculateMonthyInstallmentAmount;

trait InteractsWithSalaryAdvanceSchemas
{
    protected static function getSalaryAdvanceMainSchema(): Grid
    {
        return Forms\Components\Grid::make(3)->schema([
            Forms\Components\TextInput::make('properties.loan_amount')
                ->label(__('kiosk::filament/resources/ticket-salary-advance.fields.loan_amount.label'))
                ->prefix('IDR')
                ->numeric()
                ->mask(function (Forms\Components\TextInput\Mask $mask) {
                    return $mask
                        ->numeric()
                        ->integer() // Disallow decimal numbers.
                        ->thousandsSeparator(',') // Add a separator for thousands.
                    ;
                })
                ->reactive()
                ->required()
                ->afterStateUpdated(function (Closure $set, Closure $get) {
                    $set('properties.monthly_installment_amount', CalculateMonthyInstallmentAmount::run($get('properties.loan_amount'), $get('properties.loan_period')));
                }),
            Forms\Components\Select::make('properties.loan_period')
                ->label(__('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.label'))
                ->options([
                    LoanPeriod::THREE_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::THREE_MONTHS),
                    LoanPeriod::FOUR_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::FOUR_MONTHS),
                    LoanPeriod::FIVE_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::FIVE_MONTHS),
                    LoanPeriod::SIX_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::SIX_MONTHS),
                ])
                ->default(LoanPeriod::THREE_MONTHS)
                ->reactive()
                ->required()
                ->afterStateUpdated(function (Closure $set, Closure $get) {
                    $set('properties.monthly_installment_amount', CalculateMonthyInstallmentAmount::run($get('properties.loan_amount'), $get('properties.loan_period')));
                }),
            Forms\Components\DatePicker::make('properties.installment_start_date')
                ->label(__('kiosk::filament/resources/ticket-salary-advance.fields.installment_start_date.label'))
                ->minDate(now()->startOfMonth()->startOfDay())
                ->default(now()->startOfMonth()->startOfDay())
                ->displayFormat('d F Y')
                ->closeOnDateSelection()
                ->required(),
        ])->visible(function (Closure $get) {
            return self::checkSelectedCategorySalaryAdvance($get) && self::checkUserHasValidPayroll();
        });
    }

    protected static function getSalaryAdvanceSidebarSchema(): Group
    {
        $salary = Auth::user()->payroll->salary ?? 0;
        $maxMonthlyInstallmentAmount = (int) round(0.3 * $salary, -4);

        return Forms\Components\Group::make([
            Forms\Components\Section::make(__('kiosk::filament/resources/ticket-salary-advance.headings.payroll_information.label'))
                ->schema([
                    Forms\Components\Placeholder::make('base_salary')
                        ->label(__('kiosk::filament/resources/ticket-salary-advance.placeholders.base_salary.label'))
                        ->content(number_format($salary)),
                    Forms\Components\Placeholder::make('max_monthly_installment_amount')
                        ->label(__('kiosk::filament/resources/ticket-salary-advance.placeholders.max_monthly_installment_amount.label'))
                        ->content(number_format($maxMonthlyInstallmentAmount)),
                ]),
            Forms\Components\Section::make(__('kiosk::filament/resources/ticket-salary-advance.headings.installment_information.label'))
                ->schema([
                    Forms\Components\TextInput::make('properties.monthly_installment_amount')
                        ->label(__('kiosk::filament/resources/ticket-salary-advance.fields.monthly_installment_amount.label'))
                        ->prefix('IDR')
                        ->numeric()
                        ->mask(function (Forms\Components\TextInput\Mask $mask) {
                            return $mask
                                ->numeric()
                                ->integer() // Disallow decimal numbers.
                                ->thousandsSeparator(',') // Add a separator for thousands.
                            ;
                        })
                        ->disabled()
                        ->rules(['numeric', "max:{$maxMonthlyInstallmentAmount}"]),
                ]),
        ])
            ->visible(function (Closure $get) {
                return self::checkSelectedCategorySalaryAdvance($get) && self::checkUserHasValidPayroll();
            })
            ->columnSpan(1)
        ;
    }

    protected static function getSalaryAdvanceApprovalSchema(): Section
    {
        return Forms\Components\Section::make(__('kanri::filament/resources/ticket-salary-advance.headings.approval.label'))
            ->schema([
                Forms\Components\Placeholder::make('loan_amount')
                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.loan_amount.label'))
                    ->content(function (Model $record) {
                        return number_format($record->properties['approved_loan_amount']);
                    }),
                Forms\Components\Placeholder::make('loan_period')
                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.loan_period.label'))
                    ->content(function (Model $record) {
                        return __('kanri::filament/resources/ticket-salary-advance.placeholders.loan_period.options.' . $record->properties['approved_loan_period']);
                    }),
                Forms\Components\Placeholder::make('installment_start_date')
                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.installment_start_date.label'))
                    ->content(function (Model $record) {
                        return Carbon::parse($record->properties['approved_installment_start_date'])->format('d F Y');
                    }),
                Forms\Components\Placeholder::make('monthly_installment_amount')
                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.monthly_installment_amount.label'))
                    ->content(function (Model $record) {
                        return number_format($record->properties['approved_monthly_installment_amount']);
                    }),
            ])
            ->visible(function (?Model $record) {
                $hasApprovals =
                    ! is_null($record->properties['approved_loan_amount'] ?? null)
                    && ! is_null($record->properties['approved_loan_period'] ?? null)
                    && ! is_null($record->properties['approved_monthly_installment_amount'] ?? null)
                    && ! is_null($record->properties['approved_installment_start_date'] ?? null);

                return $hasApprovals && $record->isApproved();
            })
            ->columns(4)
        ;
    }

    protected static function checkSelectedCategorySalaryAdvance(Closure $get): bool
    {
        $salary = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY)->first();
        $advance = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY_ADVANCE)->first();

        return ($get('category_id') && $get('category_id') == $salary->id)
            && ($get('child_category_id') && $get('child_category_id') == $advance->id);
    }

    protected static function checkUserHasValidPayroll(): bool
    {
        return ! is_null(Auth::user()->payroll);
    }
}
