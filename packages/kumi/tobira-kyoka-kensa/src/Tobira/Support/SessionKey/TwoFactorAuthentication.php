<?php

namespace Kumi\Tobira\Support\SessionKey;

class TwoFactorAuthentication
{
    public const ONE_TIME_PASSWORD_SECRET = 'tobira.two-factor-authentication.one-time-password.secret';
    public const ONE_TIME_PASSWORD_CONFIRMED = 'tobira.two-factor-authentication.one-time-password.confirmed';
    public const RECOVERY_CODES = 'tobira.two-factor-authentication.recovery-codes';
}
