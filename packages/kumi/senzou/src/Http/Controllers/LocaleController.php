<?php

namespace Kumi\Senzou\Http\Controllers;

class LocaleController
{
    public function change($locale)
    {
        if (in_array($locale, ['en', 'id'])) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
