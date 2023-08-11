<?php

namespace Kumi\Tobira\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class EnsureAccountIsActivated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null $redirectToRoute
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|null
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()->isActivated()) {
            return Redirect::route('filament.account-activation.prompt');
        }

        return $next($request);
    }
}
