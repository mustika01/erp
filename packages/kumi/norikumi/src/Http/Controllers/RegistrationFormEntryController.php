<?php

namespace Kumi\Norikumi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Kumi\Norikumi\Models\RegistrationFormEntry;

class RegistrationFormEntryController
{
    public function redirect(RegistrationFormEntry $entry): RedirectResponse
    {
        abort_if($entry->isCompleted(), Response::HTTP_NOT_FOUND);

        return Redirect::route('norikumi.registration-form-entry.session', [$entry]);
    }

    public function session(RegistrationFormEntry $entry)
    {
        abort_if($entry->isCompleted(), Response::HTTP_NOT_FOUND);

        return View::make('norikumi::filament.resources.registration-form-entry.session', [
            'entry' => $entry,
        ]);
    }

    public function auth(RegistrationFormEntry $entry, Request $request)
    {
        abort_if($entry->isCompleted(), Response::HTTP_NOT_FOUND);

        $validated = $request->validate([
            'pin_code' => ['required', 'numeric', 'digits:4'],
        ]);

        $code = $validated['pin_code'];

        if ($entry->pin_code == $code) {
            $redirect = URL::temporarySignedRoute('norikumi.registration-form-entry.edit', Carbon::now()->addMinute(15), [$entry]);

            return Redirect::to($redirect);
        }

        throw ValidationException::withMessages([
            'pin_code' => 'Invalid PIN Code',
        ]);
    }

    public function edit(RegistrationFormEntry $entry, Request $request)
    {
        abort_if($entry->isCompleted(), Response::HTTP_NOT_FOUND);

        abort_unless($request->hasValidSignature(), Response::HTTP_NOT_FOUND);

        return View::make('norikumi::filament.resources.registration-form-entry.edit', [
            'entry' => $entry,
        ]);
    }

    public function complete()
    {
        return View::make('norikumi::filament.resources.registration-form-entry.complete');
    }
}
