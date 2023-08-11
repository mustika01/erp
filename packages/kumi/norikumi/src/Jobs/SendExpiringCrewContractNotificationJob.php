<?php

namespace Kumi\Norikumi\Jobs;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kumi\Norikumi\Filament\Resources\CrewResource;
use Kumi\Norikumi\Models\Contract;
use Kumi\Norikumi\Support\DefaultRoles;
use Kumi\Tobira\Models\User;

class SendExpiringCrewContractNotificationJob implements ShouldQueue
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
        $contracts = Contract::query()
            ->where('ended_at', '<', now()->addMonths(2))
            ->get()
        ;

        $contracts = $contracts
            ->filter(function (Contract $contract) {
                return $contract->ended_at->diffInDays() === 45;
            })
        ;

        $contracts
            ->each(function (Contract $contract) {
                $recipients = User::role(DefaultRoles::CREWING_USER)->get();

                $crew = $contract->crew;
                $name = $crew->name;

                Notification::make()
                    ->title("The contract for {$name} will expire in 45 days.")
                    ->actions([
                        Action::make('view')
                            ->button()
                            ->url(CrewResource::getUrl('view', [
                                'record' => $crew->getKey(),
                            ])),
                    ])
                    ->sendToDatabase($recipients)
                ;
            })
        ;
    }
}
