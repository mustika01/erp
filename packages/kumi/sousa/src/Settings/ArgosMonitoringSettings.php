<?php

namespace Kumi\Sousa\Settings;

use Spatie\LaravelSettings\Settings;

class ArgosMonitoringSettings extends Settings
{
    public const GROUP = 'argos-monitoring';

    public const KEY_USERNAME = 'username';
    public const KEY_PASSWORD = 'password';

    public string $username;
    public string $password;

    public static function group(): string
    {
        return self::GROUP;
    }
}
