<?php

namespace Kumi\Tobira\Http\Controllers\Fortify;

use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Routing\Controller;

class AccountActivationPromptController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user()->isActivated()
                    ? redirect()->intended(Filament::getUrl())
                    : view('tobira::account-activation.prompt');
    }
}
