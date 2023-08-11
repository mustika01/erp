<?php

namespace Kumi\Kyoka\Events\User;

use Illuminate\Foundation\Events\Dispatchable;

class Deactivated
{
    use Dispatchable;

    /**
     * The user the attempter was trying to authenticate as.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
