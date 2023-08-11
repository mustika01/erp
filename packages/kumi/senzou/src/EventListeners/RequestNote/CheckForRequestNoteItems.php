<?php

namespace Kumi\Senzou\EventListeners\RequestNote;

use Kumi\Senzou\Events\RequestNote\Committed;
use Kumi\Senzou\Models\RequestNoteItem;
use Kumi\Senzou\Support\Enums\RequestNoteStatus;

class CheckForRequestNoteItems
{
    public function handle(Committed $event)
    {
        $item = $event->item;
        $note = $item->note;
        $approved = $item->note->approved_items;

        $items = $note->items->reject(function (RequestNoteItem $item) {
            return ! is_null($item->committed_at);
        });

        if ($items->isEmpty()) {
            $note->status = RequestNoteStatus::IN_REVIEW;

            if ($approved->isEmpty()) {
                $note->status = RequestNoteStatus::DENIED;
            }

            $note->save();
        }
    }
}
