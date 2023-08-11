<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\LeaveRequest;

use Filament\Forms;
use Illuminate\Support\Carbon;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\TicketCategory;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kanri\Support\DefaultPermissions;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Kumi\Kanri\Actions\CalculateLeaveFinalDate;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class ApproveLeaveRequestAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('kanri::filament/resources/ticket-leave-request.actions.approve.single.label'));

        $this->modalWidth('xl');

        $this->modalHeading(__('kanri::filament/resources/ticket-leave-request.headings.tickets.approve.label'));

        $this->form([
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\TextInput::make('remaining_leave_days_count')
                        ->label(__('kanri::filament/resources/ticket-leave-request.fields.remaining_leave_days_count.label'))
                        ->disabled()
                        ->dehydrated(false)
                        ->default(function () {
                            $record = $this->getRecord();

                            return $record->properties['remaining_leave_days_count'];
                        }),
                    Forms\Components\TextInput::make('approved_leave_days_count')
                        ->label(__('kanri::filament/resources/ticket-leave-request.fields.approved_leave_days_count.label'))
                        ->numeric()
                        ->reactive()
                        ->required()
                        ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                            if (! empty($get('remaining_leave_days_count')) && ! empty($get('approved_leave_days_count'))) {
                                $remaining = (int) $get('remaining_leave_days_count');
                                $approved = (int) $get('approved_leave_days_count');
                                $remainder = $remaining - $approved;

                                $set('approved_remainder_leave_days_count', $remainder);

                                CalculateLeaveFinalDate::run($get, $set, 'approved_leave_request_start_date', 'approved_leave_days_count', 'approved_leave_request_end_date');
                            }
                        }),
                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('approved_remainder_leave_days_count')
                            ->label(__('kanri::filament/resources/ticket-leave-request.fields.approved_remainder_leave_days_count.label'))
                            ->disabled()
                            ->columnSpan(1),
                    ])->columns(2)->columnSpan(2),
                    Forms\Components\TextInput::make('approved_leave_request_start_date')
                        ->label(__('kanri::filament/resources/ticket-leave-request.fields.approved_leave_request_start_date.label'))
                        ->default(function () {
                            $record = $this->getRecord();

                            return Carbon::parse($record->properties['leave_started_at'])->format('d F Y');
                        })
                        ->disabled(),
                    Forms\Components\TextInput::make('approved_leave_request_end_date')
                        ->label(__('kanri::filament/resources/ticket-leave-request.fields.approved_leave_request_end_date.label'))
                        ->disabled(),
                ]),
        ]);

        $this->color('success');

        $this->successNotificationMessage(__('kanri::filament/resources/ticket-leave-request.messages.updated'));

        $this->action(function (): void {
            $this->process(function (Model $record, array $data) {
                $properties = $record->properties;
                $properties = $properties->merge($data);
                $record->properties = $properties;
                $record->status = TicketStatus::APPROVED;
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
            $userPositionLevel = $user->employee->latestActiveEmployment->position->level;
            $employeePositionLevel = $employee->latestActiveEmployment->position->level;
            $hasSameDepartment = $user->can(DefaultPermissions::APPROVE_ANY_LEAVE_REQUEST_TICKET)
                ? true
                : $user->employee->latestActiveEmployment->department_id === $employee->latestActiveEmployment->department_id;

            return is_null($record)
                ? false
                : $userPositionLevel > $employeePositionLevel
                    && $hasSameDepartment
                    && $record->isUnderReview()
                    && $record->category->is($salary)
                    && $record->childCategory->is($salaryAdvance);
        });
    }

    public static function make(?string $name = 'approve_leave_request'): static
    {
        return parent::make($name);
    }
}
