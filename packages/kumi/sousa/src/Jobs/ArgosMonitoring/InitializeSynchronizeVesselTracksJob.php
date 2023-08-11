<?php

namespace Kumi\Sousa\Jobs\ArgosMonitoring;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        Collection::make([
            535947,
        ])->each(function (int $AssetID) {
            SynchronizeVesselTracksJob::dispatch($AssetID);
        });
    }
}
