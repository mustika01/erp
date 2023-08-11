<?php

namespace Kumi\Sousa\Jobs\GeoTrack;

use Carbon\CarbonPeriod;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Kumi\Sousa\Http\Saloon\Connectors\GeoTrackConnector\Requests\GetAssetsRequest;

class InitializeSynchronizeVesselTracksJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $request = new GetAssetsRequest();
        $response = $request->send();

        Collection::make($response->json())
            ->map(function (array $attributes) {
                return (int) $attributes['id'];
            })
            ->each(function (int $AssetID) {
                Collection::make(
                    CarbonPeriod::create(
                        Carbon::now()->subDays(14),
                        Carbon::now()
                    )->toArray()
                )->each(function (Carbon $date) use ($AssetID) {
                    SynchronizeVesselTracksJob::dispatch($AssetID, $date);
                });
            })
        ;
    }
}
