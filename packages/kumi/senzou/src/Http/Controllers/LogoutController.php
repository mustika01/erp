<?php

namespace Kumi\Senzou\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function perform()
    {
        Auth::guard('web_vessel')->logout();

        return redirect()->route('senzou.login');
    }
}
