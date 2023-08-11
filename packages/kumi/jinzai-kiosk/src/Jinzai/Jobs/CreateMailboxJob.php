<?php

namespace Kumi\Jinzai\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Kumi\Jinzai\Http\Integrations\Mailbox\Requests\CreateMailboxRequest;

class CreateMailboxJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $email
    ) {
    }

    /**
     * Execute the job.
     *
     * @codeCoverageIgnore
     */
    public function handle(CreateMailboxRequest $request)
    {
        $request->addData('username', $this->email);

        $response = $request->send();

        throw_unless($response->ok(), Exception::class, 'The request to create mailbox has failed. Please check logs for more details.');
    }
}
