<?php

namespace Kumi\Jinzai\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateRandomPassword
{
    use AsAction;

    public function handle(): string
    {
        return Hash::make(Str::random());
    }
}
