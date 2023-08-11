<?php

namespace Kumi\Tobira\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LoginController
{
    public function __invoke(): RedirectResponse
    {
        return Redirect::route('filament.session.create');
    }
}
