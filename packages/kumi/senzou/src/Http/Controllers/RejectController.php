<?php

namespace Kumi\Senzou\Http\Controllers;

use Carbon\Carbon;
use Kumi\Senzou\Models\RequestNote;
use Kumi\Senzou\Support\Enums\RequestNoteStatus;

class RejectController
{
    public function reject(RequestNote $request_note)
    {
        $request_note->status = RequestNoteStatus::REJECTED;
        $request_note->committed_at = Carbon::now();
        $request_note->save();

        return redirect()->route('senzou.request-notes.index')
        ;
    }
}
