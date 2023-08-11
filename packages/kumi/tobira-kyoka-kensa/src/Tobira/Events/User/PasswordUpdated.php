<?php

namespace Kumi\Tobira\Events\User;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;

class PasswordUpdated
{
    use Dispatchable;

    public Authenticatable $user;
    public string $password;

    public function __construct(Authenticatable $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
}
