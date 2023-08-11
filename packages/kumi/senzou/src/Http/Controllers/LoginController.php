<?php

namespace Kumi\Senzou\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function showLoginForm()
    {
        return view('senzou::auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web_vessel')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('senzou.request-notes.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
