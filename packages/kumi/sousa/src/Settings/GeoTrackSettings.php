<?php

namespace Kumi\Sousa\Settings;

use Spatie\LaravelSettings\Settings;

class GeoTrackSettings extends Settings
{
    public const GROUP = 'geo-track';

    public const KEY_USERNAME = 'username';
    public const KEY_PASSWORD = 'password';

    public const KEY_ACCESS_TOKEN = 'accessToken';

    public string $username;
    public string $password;

    public string $accessToken;

    public static function group(): string
    {
        return self::GROUP;
    }
}
