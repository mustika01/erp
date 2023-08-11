<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Schemas;

use Closure;
use Filament\Forms;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Kiosk\Models\TicketCategory;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kiosk\Support\Enums\LeaveType;
use Kumi\Jinzai\Actions\CalculateLeaveFinalDate;
use Kumi\Jinzai\Filament\Fields\RadioButtonGroupField;

trait InteractsWithLeaveRequestSchemas
{
    protected static function getLeaveRequestMainSchema(): Grid
    {
        $latestActiveEmployment = Auth::user()->employee->latestActiveEmployment;

        if ($latestActiveEmployment) {
            $employmentStartDate = $latestActiveEmployment->joined_at;
            $employmentPeriod = $employmentStartDate->diff(Carbon::now());
            $leaveMaxDate = $employmentStartDate->copy()->addYear($employmentPeriod->y + 1)->endOfDay();
        } else {
            $leaveMaxDate = Carbon::now()->addWeek()->endOfDay();
        }

        return Forms\Components\Grid::make(3)->schema([
            Forms\Components\TextInput::make('properties.no_of_days')
                ->label(__('kiosk::filament/resources/ticket-leave-request.fields.no_of_days.label'))
                ->mask(
                    fn (Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(0) // Set the number of digits after the decimal point.
                        ->decimalSeparator(',') // Add a separator for decimal numbers.
                        ->integer() // Disallow decimal numbers.
                        ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                        ->minValue(1) // Set the minimum value that the number can be.
                        ->maxValue(30) // Set the maximum value that the number can be.
                        ->normalizeZeros() // Append or remove zeros at the end of the number.
                        ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                        ->thousandsSeparator(','), // Add a separator for thousands.
                )
                ->reactive()
                ->required()
                ->afterStateUpdated(function (Closure $get, Closure $set) {
                    CalculateLeaveFinalDate::run($get, $set);
                }),
            Forms\Components\DatePicker::make('properties.leave_started_at')
                ->label(__('kiosk::filament/resources/ticket-leave-request.fields.leave_started_at.label'))
                ->minDate(now()->addWeek()->startOfDay())
                ->maxDate($leaveMaxDate)
                ->default(now()->addWeek()->startOfDay())
                ->displayFormat('d F Y')
                ->closeOnDateSelection()
                ->reactive()
                ->required()
                ->afterStateUpdated(function (Closure $get, Closure $set) {
                    CalculateLeaveFinalDate::run($get, $set);
                }),
            Forms\Components\DatePicker::make('properties.leave_ended_at')
                ->label(__('kiosk::filament/resources/ticket-leave-request.fields.leave_ended_at.label'))
                ->disabled()
                ->displayFormat('d F Y')
                ->required(),
            Forms\Components\Textarea::make('properties.temporary_address')
                ->label(__('kiosk::filament/resources/ticket-leave-request.fields.temporary_address.label'))
                ->required()
                ->columnSpan(3),
        ])->visible(function (Model $record) {
            return self::checkSelectedCategoryLeaveRequest($record);
        });
    }

    protected static function getLeaveRequestSidebarSchema(): Card
    {
        return Forms\Components\Card::make([
            RadioButtonGroupField::make('properties.leave_type')
                ->label(__('kiosk::filament/resources/ticket-leave-request.fields.leave_type.label'))
                ->options([
                    LeaveType::ANNUAL => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::ANNUAL),
                    LeaveType::CHILD_CIRCUMCISION => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::CHILD_CIRCUMCISION),
                    LeaveType::GRADUATION => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::GRADUATION),
                    LeaveType::PATERNITY => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::PATERNITY),
                    LeaveType::MATERNITY => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::MATERNITY),
                    LeaveType::BEREAVEMENT => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::BEREAVEMENT),
                    LeaveType::GETTING_MARRIED => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::GETTING_MARRIED),
                    LeaveType::CHILD_GETTING_MARRIED => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::CHILD_GETTING_MARRIED),
                    LeaveType::OTHERS => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.options.' . LeaveType::OTHERS),
                ])
                ->descriptions([
                    LeaveType::PATERNITY => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.description.' . LeaveType::PATERNITY),
                    LeaveType::MATERNITY => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.description.' . LeaveType::MATERNITY),
                    LeaveType::BEREAVEMENT => __('kiosk::filament/resources/ticket-leave-request.fields.leave_type.description.' . LeaveType::BEREAVEMENT),
                ])
                // ->disableOptionWhen(function ($value, string $label) {
                //     $gender = Auth::user()->employee->gender;

                //     return $gender === Gender::MALE ? $value == LeaveType::PATERNITY : $value == LeaveType::MATERNITY;
                // })
                ->helperText(__('kiosk::filament/resources/ticket-leave-request.fields.leave_type.helper-text'))
                ->required(),
        ])
            ->visible(function (Model $record) {
                return self::checkSelectedCategoryLeaveRequest($record);
            })
            ->columnSpan(1)
        ;
    }

    protected static function getLeaveRequestRecommendationSchema(): Section
    {
        return Forms\Components\Section::make(__('kanri::filament/resources/ticket-leave-request.headings.recommendation.label'))
            ->schema([
                Forms\Components\Placeholder::make('remaining_leave_days_count')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.remaining_leave_days_count.label'))
                    ->content(function (Model $record) {
                        return $record->properties['remaining_leave_days_count'];
                    }),
                Forms\Components\Placeholder::make('recommended_leave_days_count')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.recommended_leave_days_count.label'))
                    ->content(function (Model $record) {
                        return $record->properties['recommended_leave_days_count'];
                    }),
                Forms\Components\Placeholder::make('reviewed_remainder_leave_days_count')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.reviewed_remainder_leave_days_count.label'))
                    ->content(function (Model $record) {
                        return $record->properties['reviewed_remainder_leave_days_count'];
                    }),
                Forms\Components\Placeholder::make('reviewed_leave_request_start_date')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.reviewed_leave_request_start_date.label'))
                    ->content(function (Model $record) {
                        return $record->properties['reviewed_leave_request_start_date'];
                    }),
                Forms\Components\Placeholder::make('reviewed_leave_request_end_date')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.reviewed_leave_request_end_date.label'))
                    ->content(function (Model $record) {
                        return $record->properties['reviewed_leave_request_end_date'];
                    }),
            ])
            ->visible(function (?Model $record) {
                $hasRecommendations =
                    ! is_null($record->properties['remaining_leave_days_count'] ?? null)
                    && ! is_null($record->properties['recommended_leave_days_count'] ?? null)
                    && ! is_null($record->properties['reviewed_remainder_leave_days_count'] ?? null);

                return $hasRecommendations && ! $record->isPending();
            })
            ->columns(5)
        ;
    }

    protected static function getLeaveRequestApprovalSchema(): Section
    {
        return Forms\Components\Section::make(__('kanri::filament/resources/ticket-leave-request.headings.approved.label'))
            ->schema([
                Forms\Components\Placeholder::make('remaining_leave_days_count')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.remaining_leave_days_count.label'))
                    ->content(function (Model $record) {
                        return $record->properties['remaining_leave_days_count'];
                    }),
                Forms\Components\Placeholder::make('approved_leave_days_count')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.approved_leave_days_count.label'))
                    ->content(function (Model $record) {
                        return $record->properties['approved_leave_days_count'];
                    }),
                Forms\Components\Placeholder::make('approved_remainder_leave_days_count')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.approved_remainder_leave_days_count.label'))
                    ->content(function (Model $record) {
                        return $record->properties['approved_remainder_leave_days_count'];
                    }),
                Forms\Components\Placeholder::make('approved_leave_request_start_date')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.approved_leave_request_start_date.label'))
                    ->content(function (Model $record) {
                        return $record->properties['approved_leave_request_start_date'];
                    }),
                Forms\Components\Placeholder::make('approved_leave_request_end_date')
                    ->label(__('kanri::filament/resources/ticket-leave-request.placeholders.approved_leave_request_end_date.label'))
                    ->content(function (Model $record) {
                        return $record->properties['approved_leave_request_end_date'];
                    }),
            ])
            ->visible(function (?Model $record) {
                $hasRecommendations =
                    ! is_null($record->properties['remaining_leave_days_count'] ?? null)
                    && ! is_null($record->properties['approved_leave_days_count'] ?? null)
                    && ! is_null($record->properties['approved_remainder_leave_days_count'] ?? null);

                return $hasRecommendations && ! $record->isPending();
            })
            ->columns(5)
        ;
    }

    protected static function checkSelectedCategoryLeaveRequest(Model $record): bool
    {
        $attendance = TicketCategory::query()->where('slug', TicketCategory::KEY_ATTENDANCE)->first();
        $leave = TicketCategory::query()->where('slug', TicketCategory::KEY_LEAVE_REQUEST)->first();

        return $record->category_id === $attendance->id
            && $record->child_category_id === $leave->id;
    }
}
