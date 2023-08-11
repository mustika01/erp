<?php

namespace Kumi\Kyoka\Tests\Actions\Role;

use Kumi\Tobira\Models\User;
use Kumi\Kensa\AuthenticatedTestCase;
use Kumi\Kyoka\Actions\User\CheckForLoggedInRecord;

/**
 * @internal
 */
class CheckForLoggedInRecordTest extends AuthenticatedTestCase
{
    /** @test */
    public function it_can_return_true_upon_encountering_logged_in_user(): void
    {
        $result = CheckForLoggedInRecord::run(User::all());

        $this->assertTrue($result);
    }
}
