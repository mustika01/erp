<?php

namespace Kumi\Jinzai\Tests\Jobs;

use Kumi\Tobira\Models\User;
use Illuminate\Support\Facades\Queue;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;
use Kumi\Tobira\Events\User\PasswordUpdated;
use Kumi\Jinzai\Jobs\UpdateMailboxPasswordJob;

/**
 * @internal
 */
class UpdateMailboxPasswordJobTest extends TestCase
{
    /** @test */
    public function it_can_be_processed(): void
    {
        Queue::fake();

        $user = User::factory()->create();
        $password = 'password';

        PasswordUpdated::dispatch($user, $password);

        Queue::assertPushed(UpdateMailboxPasswordJob::class);
    }
}
