<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\GeoTrackTokenConnector\Actions;

use Illuminate\Support\Facades\App;
use Kumi\Sousa\Settings\GeoTrackSettings;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Sousa\Http\Saloon\Connectors\GeoTrackTokenConnector\Requests\GetTokenRequest;

class InitializeAccessToken
{
    use AsAction;

    public function handle()
    {
        $settings = App::make(GeoTrackSettings::class);

        $accessToken = $settings->accessToken;

        if (empty($accessToken)) {
            $request = new GetTokenRequest($settings->{GeoTrackSettings::KEY_USERNAME}, $settings->{GeoTrackSettings::KEY_PASSWORD});
            $response = $request->send();
            $data = $response->json();

            $settings->{GeoTrackSettings::KEY_ACCESS_TOKEN} = $data['token'];
            $settings->save();
        }

        return $settings->accessToken;
    }
}
