<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\HumanCapital;

use Filament\Forms;
use Filament\Pages\Actions\Action;
use Kumi\Kiosk\Models\TicketCategory;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kiosk\Support\Enums\LoanPeriod;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Kumi\Kiosk\Actions\CalculateMonthyInstallmentAmount;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class ReviewSalaryAdvanceAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('kanri::filament/resources/ticket-salary-advance.actions.review.single.label'));

        $this->modalWidth('sm');

        $this->modalHeading(__('kanri::filament/resources/ticket-salary-advance.headings.tickets.review.label'));

        $this->form([
            Forms\Components\Hidden::make('max_monthly_installment_amount')
                ->default(function () {
                    $record = $this->getRecord();

                    $salary = $record->employee->payroll->salary ?? 0;

                    return (int) round(0.3 * $salary, -4);
                }),
            Forms\Components\TextInput::make('recommended_loan_amount')
                ->label(__('kanri::filament/resources/ticket-salary-advance.fields.recommended_loan_amount.label'))
                ->prefix('IDR')
                ->numeric()
                ->mask(function (Forms\Components\TextInput\Mask $mask) {
                    return $mask
                        ->numeric()
                        ->integer() // Disallow decimal numbers.
                        ->thousandsSeparator(',') // Add a separator for thousands.
                    ;
                })
                ->default(function () {
                    $record = $this->getRecord();

                    return $record->properties['loan_amount'];
                })
                ->reactive()
                ->required()
                ->afterStateUpdated(function (\Closure $set, \Closure $get) {
                    $set(
                        'recommended_monthly_installment_amount',
                        CalculateMonthyInstallmentAmount::run($get('recommended_loan_amount'), $get('recommended_loan_period'))
                    );
                }),
            Forms\Components\Select::make('recommended_loan_period')
                ->label(__('kanri::filament/resources/ticket-salary-advance.fields.recommended_loan_period.label'))
                ->options([
                    LoanPeriod::THREE_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::THREE_MONTHS),
                    LoanPeriod::FOUR_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::FOUR_MONTHS),
                    LoanPeriod::FIVE_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::FIVE_MONTHS),
                    LoanPeriod::SIX_MONTHS => __('kiosk::filament/resources/ticket-salary-advance.fields.loan_period.options.' . LoanPeriod::SIX_MONTHS),
                ])
                ->default(function () {
                    $record = $this->getRecord();

                    return $record->properties['loan_period'];
                })
                ->reactive()
                ->required()
                ->afterStateUpdated(function (\Closure $set, \Closure $get) {
                    $set(
                        'recommended_monthly_installment_amount',
                        CalculateMonthyInstallmentAmount::run($get('recommended_loan_amount'), $get('recommended_loan_period'))
                    );
                }),
            Forms\Components\DatePicker::make('recommended_installment_start_date')
                ->label(__('kanri::filament/resources/ticket-salary-advance.fields.recommended_installment_start_date.label'))
                ->minDate(now()->startOfMonth()->startOfDay())
                ->default(function () {
                    $record = $this->getRecord();

                    return $record->properties['installment_start_date'];
                })
                ->displayFormat('d F Y')
                ->required(),
            Forms\Components\TextInput::make('recommended_monthly_installment_amount')
                ->label(__('kanri::filament/resources/ticket-salary-advance.fields.recommended_monthly_installment_amount.label'))
                ->prefix('IDR')
                ->numeric()
                ->mask(function (Forms\Components\TextInput\Mask $mask) {
                    return $mask
                        ->numeric()
                        ->integer() // Disallow decimal numbers.
                        ->thousandsSeparator(',') // Add a separator for thousands.
                    ;
                })
                ->default(function () {
                    $record = $this->getRecord();

                    return $record->properties['monthly_installment_amount'];
                })
                ->disabled()
                ->lte('max_monthly_installment_amount'),
        ]);

        $this->successNotificationMessage(__('kanri::filament/resources/ticket-salary-advance.messages.updated'));

        $this->action(function (): void {
            $this->process(function (Model $record, array $data) {
                $properties = $record->properties;
                $properties = $properties->merge($data);
                $record->properties = $properties;
                $record->status = TicketStatus::UNDER_REVIEW;
                $record->save();
            });

            $this->success();
        });

        $this->visible(function (?Model $record) {
            $salary = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY)->first();
            $salaryAdvance = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY_ADVANCE)->first();

            return is_null($record) ? false : $record->isPending() && $record->category->is($salary) && $record->childCategory->is($salaryAdvance);
        });
    }

    public static function make(?string $name = 'review_salary_advance'): static
    {
        return parent::make($name);
    }
}
