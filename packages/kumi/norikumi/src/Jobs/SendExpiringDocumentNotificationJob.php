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
use Kumi\Norikumi\Models\Document;
use Kumi\Norikumi\Support\DefaultRoles;
use Kumi\Tobira\Models\User;

class SendExpiringDocumentNotificationJob implements ShouldQueue
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
     *
     * @codeCoverageIgnore
     */
    public function handle()
    {
        $documents = Document::query()
            ->where('expired_at', '<', now()->addMonths(2))
            ->get()
        ;

        $documents = $documents->filter(function (Document $document) {
            return $document->expired_at->diffInDays() === 45;
        });

        $documents
            ->each(function (Document $document) {
                $recipients = User::role(DefaultRoles::CREWING_USER)->get();

                $crew = $document->crew;
                $name = $crew->name;

                $documentType = __('norikumi::filament/resources/document.columns.type.options.' . $document->type);

                Notification::make()
                    ->title("The {$documentType} for {$name} will expire in 45 days.")
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
