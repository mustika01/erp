<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\LeaveRequest;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\TicketCategory;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Kumi\Kanri\Actions\CalculateLeaveFinalDate;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class ReviewLeaveRequestAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('kanri::filament/resources/ticket-leave-request.actions.review.single.label'));

        $this->modalWidth('xl');

        $this->modalHeading(__('kanri::filament/resources/ticket-leave-request.headings.tickets.review.label'));

        $this->form([
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\TextInput::make('remaining_leave_days_count')
                        ->label(__('kanri::filament/resources/ticket-leave-request.fields.remaining_leave_days_count.label'))
                        ->numeric()
                        ->reactive()
                        ->required()
                        ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                            if (! empty($get('remaining_leave_days_count')) && ! empty($get('recommended_leave_days_count'))) {
                                $remaining = (int) $get('remaining_leave_days_count');
                                $recommended = (int) $get('recommended_leave_days_count');
                                $remainder = $remaining - $recommended;

                                $set('reviewed_remainder_leave_days_count', $remainder);

                                CalculateLeaveFinalDate::run($get, $set, 'reviewed_leave_request_start_date', 'recommended_leave_days_count', 'reviewed_leave_request_end_date');
                            }
                        }),
                    Forms\Components\TextInput::make('recommended_leave_days_count')
                        ->label(__('kanri::filament/resources/ticket-leave-request.fields.recommended_leave_days_count.label'))
                        ->numeric()
                        ->reactive()
                        ->required()
                        ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                            if (! empty($get('remaining_leave_days_count')) && ! empty($get('recommended_leave_days_count'))) {
                                $remaining = (int) $get('remaining_leave_days_count');
                                $recommended = (int) $get('recommended_leave_days_count');
                                $remainder = $remaining - $recommended;

                                $set('reviewed_remainder_leave_days_count', $remainder);

                                CalculateLeaveFinalDate::run($get, $set, 'reviewed_leave_request_start_date', 'recommended_leave_days_count', 'reviewed_leave_request_end_date');
                            }
                        }),
                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('reviewed_remainder_leave_days_count')
                            ->label(__('kanri::filament/resources/ticket-leave-request.fields.reviewed_remainder_leave_days_count.label'))
                            ->disabled()
                            ->columnSpan(1),
                    ])->columns(2)->columnSpan(2),
                    Forms\Components\TextInput::make('reviewed_leave_request_start_date')
                        ->label(__('kanri::filament/resources/ticket-leave-request.fields.reviewed_leave_request_start_date.label'))
                        ->default(function () {
                            $record = $this->getRecord();

                            return Carbon::parse($record->properties['leave_started_at'])->format('d F Y');
                        })
                        ->disabled(),
                    Forms\Components\TextInput::make('reviewed_leave_request_end_date')
                        ->label(__('kanri::filament/resources/ticket-leave-request.fields.reviewed_leave_request_end_date.label'))
                        ->disabled(),
                ]),
        ]);

        $this->color('secondary');

        $this->successNotificationMessage(__('kanri::filament/resources/ticket-leave-request.messages.updated'));

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
            $user = Auth::user();
            $userHasActiveEmployment = $user->employee->hasActiveEmployment();
            $employee = $record->employee;
            $employeeHasActiveEmployment = $employee->hasActiveEmployment();

            if (! $userHasActiveEmployment && ! $employeeHasActiveEmployment) {
                return false;
            }

            $salary = TicketCategory::query()->where('slug', TicketCategory::KEY_ATTENDANCE)->first();
            $salaryAdvance = TicketCategory::query()->where('slug', TicketCategory::KEY_LEAVE_REQUEST)->first();

            return is_null($record)
                ? false
                : $record->isPending()
                    && $record->category->is($salary)
                    && $record->childCategory->is($salaryAdvance);
        });
    }

    public static function make(?string $name = 'review_leave_request'): static
    {
        return parent::make($name);
    }
}
