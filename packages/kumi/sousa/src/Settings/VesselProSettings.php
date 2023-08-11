<?php

namespace Kumi\Sousa\Settings;

use Carbon\Carbon;
use Spatie\LaravelSettings\Settings;

class VesselProSettings extends Settings
{
    public const GROUP = 'vessel-pro';

    public const KEY_USERNAME = 'username';
    public const KEY_PASSWORD = 'password';

    public const KEY_ACCESS_TOKEN = 'accessToken';
    public const KEY_TOKEN_TYPE = 'tokenType';
    public const KEY_EXPIRED_TIMESTAMP = 'expiredTimestamp';

    public string $username;
    public string $password;

    public string $accessToken;
    public string $tokenType;
    public Carbon $expiredTimestamp;

    public static function group(): string
    {
        return self::GROUP;
    }
}
