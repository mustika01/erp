<?php

namespace Kumi\Sousa\Models\VesselDocument\Traits;

trait InteractsWithAttachments
{
    /**
     * Initialize trait.
     */
    public function initializeInteractsWithAttachments(): void
    {
        $this->addMediaCollection('attachments')
            ->onlyKeepLatest(5)
        ;
    }
}
