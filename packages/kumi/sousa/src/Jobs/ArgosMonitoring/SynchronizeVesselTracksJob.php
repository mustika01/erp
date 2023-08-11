<?php

namespace Kumi\Sousa\Jobs\ArgosMonitoring;

use Illuminate\Bus\Queueable;
use Kumi\Sousa\Models\Vessel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Models\VesselTrack;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Kumi\Sousa\Http\Saloon\Connectors\ArgosMonitoringConnector\Requests\GetTracksHistoryRequest;

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
        public int $assetId,
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
            ['tracking_provider_name', '=', 'argos-monitoring'],
        ]);

        if ($vessel) {
            $tracks = Collection::make($response->json()['data'])
                ->map(function (array $attributes) {
                    $trackId = Carbon::parse($attributes['date'])->getTimestamp();

                    $exists = VesselTrack::query()->where([
                        ['provider_tracking_id', '=', $trackId],
                        ['provider_asset_id', '=', $this->assetId],
                    ])->exists();

                    if (! $exists) {
                        $start = Carbon::parse($attributes['date']);
                        $finish = Carbon::parse($attributes['date']);

                        $data = [
                            'provider_tracking_id' => $trackId,
                            'provider_asset_id' => $this->assetId,
                            'latitude' => $attributes['lat'],
                            'longitude' => $attributes['lon'],
                            'speed' => round($attributes['speed'], 2),
                            'cardinal_direction' => $this->calculateCardinalDirection($attributes['heading']),
                            'cardinal_angle' => (int) $attributes['heading'],
                            'status' => 'N/A',
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

    protected function calculateCardinalDirection(float $degree): string
    {
        return match (true) {
            337.5 <= $degree || $degree < 22.5 => 'N',
            22.5 <= $degree || $degree < 67.5 => 'NE',
            67.5 <= $degree || $degree < 112.5 => 'E',
            112.5 <= $degree || $degree < 157.5 => 'SE',
            157.5 <= $degree || $degree < 202.5 => 'S',
            202.5 <= $degree || $degree < 247.5 => 'SW',
            247.5 <= $degree || $degree < 292.5 => 'W',
            292.5 <= $degree || $degree < 337.5 => 'NW',
            default => 'N/A',
        };
    }
}
