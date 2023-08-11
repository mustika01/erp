<?php

namespace Kumi\Kyoka\Tests\Actions\Role;

use Kumi\Kensa\TestCase;
use Kumi\Kyoka\Models\Role;
use Kumi\Kyoka\Actions\Role\CheckForNonEditableRecords;

/**
 * @internal
 */
class CheckForNonEditableRecordsTest extends TestCase
{
    /** @test */
    public function it_can_return_false_upon_encountering_non_editable_record(): void
    {
        Role::factory()->create();

        CheckForNonEditableRecords::run(Role::all());

        // This should return 9 (8 from the seeders, 1 from the factory) records.
        $this->assertDatabaseCount(Role::class, 9);
    }
}
