<?php

namespace Kumi\Jinzai\Events\Employment;

use Kumi\Jinzai\Models\Employment;

class Updated
{
    public Employment $employment;

    public function __construct(Employment $employment)
    {
        $this->employment = $employment;
    }
}
