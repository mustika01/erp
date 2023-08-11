<?php

namespace Kumi\Sousa\Jobs\VesselPro;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Kumi\Sousa\Http\Saloon\Connectors\VesselProConnector\Requests\GetAssetsRequest;

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
                return (int) $attributes['AssetID'];
            })
            ->each(function (int $AssetID) {
                SynchronizeVesselTracksJob::dispatch($AssetID);
            })
        ;
    }
}
