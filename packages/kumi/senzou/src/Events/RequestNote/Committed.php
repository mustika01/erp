<?php

namespace Kumi\Senzou\Events\RequestNote;

use Illuminate\Foundation\Events\Dispatchable;
use Kumi\Senzou\Models\RequestNoteItem;

class Committed
{
    use Dispatchable;

    public function __construct(
        public RequestNoteItem $item
    ) {
    }
}
