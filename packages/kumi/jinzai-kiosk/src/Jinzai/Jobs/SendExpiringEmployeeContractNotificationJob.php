<?php

namespace Kumi\Jinzai\Jobs;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kumi\Jinzai\Filament\Resources\ContractResource;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;
use Kumi\Jinzai\Models\Employment;
use Kumi\Jinzai\Support\DefaultRoles;
use Kumi\Tobira\Models\User;

class SendExpiringEmployeeContractNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->sendNotificationForHumanCapitalUser();
        $this->sendNotificationForLegalOfficer();
    }

    public function sendNotificationForHumanCapitalUser()
    {
        $employments = Employment::query()
            ->whereNotNull('contract_ended_at')
            ->get()
        ;

        $employments = $employments->filter(function (Employment $employment) {
            return $employment->contract_ended_at->diffInDays() === 30;
        });

        $employments->each(function (Employment $employment) {
            $recipients = User::role(DefaultRoles::HUMAN_CAPITAL_USER)->get();

            $employee = $employment->employee;
            $employeeName = $employee->user->name;

            Notification::make()
                ->title("Employment for {$employeeName} will expire in 30 days.")
                ->actions([
                    Action::make('view')
                        ->button()
                        ->url(EmployeeResource::getUrl('view', [
                            'record' => $employee,
                        ])),
                ])
                ->sendToDatabase($recipients)
            ;
        });
    }

    public function sendNotificationForLegalOfficer()
    {
        $employments = Employment::query()
            ->whereNotNull('contract_ended_at')
            ->get()
        ;

        $employments = $employments->filter(function (Employment $employment) {
            return $employment->contract_ended_at->diffInDays() === 30;
        });

        $employments->each(function (Employment $employment) {
            $recipients = User::role(DefaultRoles::LEGAL_OFFICER)->get();

            $employee = $employment->employee;
            $employeeName = $employee->user->name;

            Notification::make()
                ->title("Employment for {$employeeName} will expire in 30 days.")
                ->actions([
                    Action::make('view')
                        ->button()
                        ->url(ContractResource::getUrl('view', [
                            'record' => $employee,
                        ])),
                ])
                ->sendToDatabase($recipients)
            ;
        });
    }
}
