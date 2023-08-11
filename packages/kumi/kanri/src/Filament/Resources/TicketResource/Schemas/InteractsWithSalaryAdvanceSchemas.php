<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Schemas;

use Filament\Forms;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\TicketCategory;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kiosk\Support\Enums\LoanPeriod;
use Kumi\Kanri\Support\DefaultPermissions;

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
                }),
            Forms\Components\Select::make('properties.loan_period')
                ->label(__('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.label'))
                ->options([
                    LoanPeriod::THREE_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::THREE_MONTHS),
                    LoanPeriod::FOUR_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::FOUR_MONTHS),
                    LoanPeriod::FIVE_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::FIVE_MONTHS),
                    LoanPeriod::SIX_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::SIX_MONTHS),
                ]),
            Forms\Components\DatePicker::make('properties.installment_start_date')
                ->label(__('kiosk::filament/resources/ticket-salary-advance.fields.installment_start_date.label'))
                ->displayFormat('d F Y'),
        ])->visible(function (Model $record) {
            return self::checkSelectedCategorySalaryAdvance($record);
        });
    }

    protected static function getSalaryAdvanceSidebarSchema(): Group
    {
        return Forms\Components\Group::make([
            Forms\Components\Section::make(__('kanri::filament/resources/ticket-salary-advance.headings.payroll_information.label'))
                ->schema([
                    Forms\Components\Placeholder::make('base_salary')
                        ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.base_salary.label'))
                        ->content(function (?Model $record) {
                            return number_format($record->employee->payroll->salary);
                        }),
                    Forms\Components\Placeholder::make('max_monthly_installment_amount')
                        ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.max_monthly_installment_amount.label'))
                        ->content(function (?Model $record) {
                            return number_format((int) round(0.3 * $record->employee->payroll->salary, -4));
                        }),
                ])
                ->visible(function () {
                    return Auth::user()->can(DefaultPermissions::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION);
                }),
            Forms\Components\Section::make(__('kanri::filament/resources/ticket-salary-advance.headings.installment_information.label'))
                ->schema([
                    Forms\Components\Placeholder::make('properties.monthly_installment_amount')
                        ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.monthly_installment_amount.label'))
                        ->content(function (?Model $record) {
                            return number_format($record->properties['monthly_installment_amount']);
                        }),
                ]),
        ])
            ->disabled()
            ->visible(function (Model $record) {
                return self::checkSelectedCategorySalaryAdvance($record);
            })
            ->columnSpan(1)
        ;
    }

    protected static function getSalaryAdvanceRecommendationSchema(): Section
    {
        return Forms\Components\Section::make(__('kanri::filament/resources/ticket-salary-advance.headings.recommendation.label'))
            ->schema([
                Forms\Components\Placeholder::make('loan_amount')
                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.loan_amount.label'))
                    ->content(function (Model $record) {
                        return number_format($record->properties['recommended_loan_amount']);
                    }),
                Forms\Components\Placeholder::make('loan_period')
                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.loan_period.label'))
                    ->content(function (Model $record) {
                        return __('kanri::filament/resources/ticket-salary-advance.placeholders.loan_period.options.' . $record->properties['recommended_loan_period']);
                    }),
                Forms\Components\Placeholder::make('installment_start_date')
                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.installment_start_date.label'))
                    ->content(function (Model $record) {
                        return Carbon::parse($record->properties['recommended_installment_start_date'])->format('d F Y');
                    }),
                Forms\Components\Placeholder::make('monthly_installment_amount')
                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.monthly_installment_amount.label'))
                    ->content(function (Model $record) {
                        return number_format($record->properties['recommended_monthly_installment_amount']);
                    }),
            ])
            ->visible(function (?Model $record) {
                $hasRecommendations =
                    ! is_null($record->properties['recommended_loan_amount'] ?? null)
                    && ! is_null($record->properties['recommended_loan_period'] ?? null)
                    && ! is_null($record->properties['recommended_monthly_installment_amount'] ?? null)
                    && ! is_null($record->properties['recommended_installment_start_date'] ?? null);

                return $hasRecommendations && ! $record->isPending();
            })
            ->columns(4)
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

    protected static function checkSelectedCategorySalaryAdvance(Model $record): bool
    {
        $salary = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY)->first();
        $advance = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY_ADVANCE)->first();

        return $record->category_id === $salary->id
            && $record->child_category_id === $advance->id;
    }
}
