<?php

namespace Kumi\Norikumi\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class GenerateRandomPINCode
{
    use AsAction;

    public function handle(): int
    {
        return random_int(1000, 9999);
    }
}
