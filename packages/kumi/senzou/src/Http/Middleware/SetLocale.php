<?php

namespace Kumi\Senzou\Http\Middleware;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale', 'en'));
        }

        return $next($request);
    }
}
