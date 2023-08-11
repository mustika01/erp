<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\VesselProTokenConnector\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Sousa\Settings\VesselProSettings;
use Kumi\Sousa\Http\Saloon\Connectors\VesselProTokenConnector\Requests\GetTokenRequest;

class InitializeAccessToken
{
    use AsAction;

    public function handle()
    {
        $settings = App::make(VesselProSettings::class);

        $isPast = $settings->expiredTimestamp->isPast();

        if ($isPast) {
            $request = new GetTokenRequest($settings->{VesselProSettings::KEY_USERNAME}, $settings->{VesselProSettings::KEY_PASSWORD});
            $response = $request->send();
            $data = $response->json();

            $settings->{VesselProSettings::KEY_ACCESS_TOKEN} = $data['access_token'];
            $settings->{VesselProSettings::KEY_TOKEN_TYPE} = $data['token_type'];
            $settings->{VesselProSettings::KEY_EXPIRED_TIMESTAMP} = Carbon::now()->addSeconds($data['expires_in'] - 300);
            $settings->save();
        }

        return $settings->accessToken;
    }
}
