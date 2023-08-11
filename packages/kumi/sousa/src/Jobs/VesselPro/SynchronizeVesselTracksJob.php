<?php

namespace Kumi\Sousa\Jobs\VesselPro;

use Illuminate\Bus\Queueable;
use Kumi\Sousa\Models\Vessel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Models\VesselTrack;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Kumi\Sousa\Http\Saloon\Connectors\VesselProConnector\Requests\GetTracksHistoryRequest;

class SynchronizeVesselTracksJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $assetId
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $request = new GetTracksHistoryRequest($this->assetId);
        $response = $request->send();

        $vessel = Vessel::query()->firstWhere([
            ['tracking_asset_id', '=', $this->assetId],
            ['tracking_provider_name', '=', 'vessel-pro'],
        ]);

        if ($vessel) {
            $tracks = Collection::make($response->json())
                ->map(function (array $attributes) {
                    $exists = VesselTrack::query()->where([
                        ['provider_tracking_id', '=', $attributes['TrackID']],
                        ['provider_asset_id', '=', $attributes['AssetID']],
                    ])->exists();

                    if (! $exists) {
                        $start = Carbon::parse($attributes['GPSTimeStart'])->shiftTimezone($attributes['TimeZone'])->setTimezone('UTC');
                        $finish = Carbon::parse($attributes['GPSTimeEnd'])->shiftTimezone($attributes['TimeZone'])->setTimezone('UTC');

                        $data = [
                            'provider_tracking_id' => $attributes['TrackID'],
                            'provider_asset_id' => $attributes['AssetID'],
                            'latitude' => $attributes['Latitude'],
                            'longitude' => $attributes['Longitude'],
                            'speed' => $attributes['Speed'],
                            'cardinal_direction' => $attributes['DirectionCardinal'],
                            'cardinal_angle' => $attributes['DirectionDegrees'],
                            'status' => $attributes['Status'],
                            'tracking_started_at' => $start,
                            'tracking_finished_at' => $finish,
                        ];

                        return new VesselTrack($data);
                    }
                })
                ->filter()
            ;

            $vessel->tracks()->saveMany($tracks);
        }
    }
}
