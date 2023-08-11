<?php

use Kumi\Sousa\Settings\GeoTrackSettings;
use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeoTrackSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup(GeoTrackSettings::GROUP, function (SettingsBlueprint $blueprint): void {
            $blueprint->add(GeoTrackSettings::KEY_USERNAME, 'A6.LBN.03');
            $blueprint->add(GeoTrackSettings::KEY_PASSWORD, 'a6lbn0303');

            $blueprint->add(GeoTrackSettings::KEY_ACCESS_TOKEN, '');
        });
    }
}
