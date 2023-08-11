<?php

use Kumi\Sousa\Settings\GeoTrackSettings;
use Kumi\Sousa\Settings\ArgosMonitoringSettings;
use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateArgosMonitoringSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup(ArgosMonitoringSettings::GROUP, function (SettingsBlueprint $blueprint): void {
            $blueprint->add(GeoTrackSettings::KEY_USERNAME, 'aurora_petrol');
            $blueprint->add(GeoTrackSettings::KEY_PASSWORD, 'AURORAPETROL');
        });
    }
}
