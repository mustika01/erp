<?php

namespace Kumi\Tobira\Actions\TwoFactorAuthentication;

use Illuminate\Support\Facades\Session;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Tobira\Support\SessionKey\TwoFactorAuthentication;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;

class GenerateSecret
{
    use AsAction;

    protected TwoFactorAuthenticationProvider $provider;

    public function __construct(TwoFactorAuthenticationProvider $provider)
    {
        $this->provider = $provider;
    }

    public function handle(): string
    {
        $secret = Session::get(TwoFactorAuthentication::ONE_TIME_PASSWORD_SECRET);

        return is_null($secret) ? $this->generateSecretFromProvider() : $secret;
    }

    protected function generateSecretFromProvider(): string
    {
        $secret = $this->provider->generateSecretKey();

        Session::put(TwoFactorAuthentication::ONE_TIME_PASSWORD_SECRET, $secret);

        return $secret;
    }
}
