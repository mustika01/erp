<?php

use Illuminate\Support\Carbon;
use Kumi\Sousa\Settings\VesselProSettings;
use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateVesselProSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup(VesselProSettings::GROUP, function (SettingsBlueprint $blueprint): void {
            $blueprint->add(VesselProSettings::KEY_USERNAME, 'lintas');
            $blueprint->add(VesselProSettings::KEY_PASSWORD, 'bahari');

            $blueprint->add(VesselProSettings::KEY_ACCESS_TOKEN, '');
            $blueprint->add(VesselProSettings::KEY_TOKEN_TYPE, '');
            $blueprint->add(VesselProSettings::KEY_EXPIRED_TIMESTAMP, Carbon::parse('2022-01-01 00:00:00'));
        });
    }
}
