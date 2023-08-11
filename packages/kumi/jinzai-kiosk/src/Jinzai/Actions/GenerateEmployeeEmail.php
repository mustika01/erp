<?php

namespace Kumi\Jinzai\Actions;

use Illuminate\Support\Str;
use Kumi\Tobira\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateEmployeeEmail
{
    use AsAction;

    public function handle(?string $name): string
    {
        if (is_null($name)) {
            return '';
        }

        $names = Str::of($name)->slug()->explode('-');

        if ($names->count() >= 2 && $names->last() !== '') {
            $name = Str::lower($names->first() . '.' . $names->last());
        } else {
            $name = Str::lower($names->first());
        }

        $email = $name . '@em.lbn.co.id';

        $exists = User::query()->where('email', $email)->exists();

        while ($exists) {
            $email = $name . random_int(1000, 9999) . '@em.lbn.co.id';

            $exists = User::query()->where('email', $email)->exists();
        }

        return $email;
    }
}
