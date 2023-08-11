<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\ArgosMonitoringConnector\Actions;

use Illuminate\Support\Facades\App;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Sousa\Settings\ArgosMonitoringSettings;

class RetrieveCredentials
{
    use AsAction;

    public function handle()
    {
        $settings = App::make(ArgosMonitoringSettings::class);

        return [
            'username' => $settings->username,
            'password' => $settings->password,
        ];
    }
}
