<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\HumanCapital;

use Filament\Pages\Actions\Action;
use Kumi\Kiosk\Models\TicketCategory;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class RejectSalaryAdvanceAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('kanri::filament/resources/ticket-salary-advance.actions.reject.single.label'));

        $this->modalWidth('sm');

        $this->modalHeading(__('kanri::filament/resources/ticket-salary-advance.headings.tickets.reject.label'));

        $this->color('danger');

        $this->requiresConfirmation();

        $this->successNotificationMessage(__('kanri::filament/resources/ticket-salary-advance.messages.updated'));

        $this->action(function (): void {
            $this->process(function (Model $record, array $data) {
                $record->status = TicketStatus::REJECTED;
                $record->save();
            });

            $this->success();
        });

        $this->visible(function (?Model $record) {
            $salary = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY)->first();
            $salaryAdvance = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY_ADVANCE)->first();

            return is_null($record)
                ? false
                : ($record->isPending() || $record->isUnderReview())
                    && $record->category->is($salary)
                    && $record->childCategory->is($salaryAdvance);
        });
    }

    public static function make(?string $name = 'reject_salary_advance'): static
    {
        return parent::make($name);
    }
}
