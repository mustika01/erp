<?php

namespace Kumi\Sousa\Jobs\GeoTrack;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Http\Saloon\Connectors\GeoTrackConnector\Requests\GetTracksHistoryRequest;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VesselTrack;

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
        public Carbon $date,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $request = new GetTracksHistoryRequest($this->assetId, $this->date);
        $response = $request->send();

        $vessel = Vessel::query()->firstWhere([
            ['tracking_asset_id', '=', $this->assetId],
            ['tracking_provider_name', '=', 'geo-track'],
        ]);

        if ($vessel) {
            $tracks = Collection::make($response->json())
                ->map(function (array $attributes) {
                    $trackId = Carbon::parse($attributes['serverUtc'])->getTimestamp();

                    $exists = VesselTrack::query()->where([
                        ['provider_tracking_id', '=', $trackId],
                        ['provider_asset_id', '=', $this->assetId],
                    ])->exists();

                    if (! $exists) {
                        $start = Carbon::parse($attributes['serverUtc']);
                        $finish = Carbon::parse($attributes['serverUtc']);

                        $data = [
                            'provider_tracking_id' => $trackId,
                            'provider_asset_id' => $this->assetId,
                            'latitude' => $attributes['position']['latitude'],
                            'longitude' => $attributes['position']['longitude'],
                            'speed' => round($attributes['variables']['speed'], 2) * 1.943844,
                            'cardinal_direction' => $this->calculateCardinalDirection($attributes['velocity']['heading']),
                            'cardinal_angle' => (int) $attributes['velocity']['heading'],
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
