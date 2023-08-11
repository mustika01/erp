<?php

namespace Kumi\Jinzai\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Kumi\Jinzai\Http\Integrations\Mailbox\Requests\UpdateMailboxPasswordRequest;

class UpdateMailboxPasswordJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }

    /**
     * Execute the job.
     *
     * @codeCoverageIgnore
     */
    public function handle()
    {
        $request = new UpdateMailboxPasswordRequest($this->email);

        $request->addData('password', $this->password);

        $response = $request->send();

        throw_unless($response->ok(), Exception::class, 'The request to update mailbox password has failed. Please check logs for more details.');
    }
}
