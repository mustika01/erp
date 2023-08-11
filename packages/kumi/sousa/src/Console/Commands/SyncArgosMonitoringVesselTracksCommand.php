<?php

namespace Kumi\Sousa\Console\Commands;

use Illuminate\Console\Command;
use Kumi\Sousa\Jobs\ArgosMonitoring\InitializeSynchronizeVesselTracksJob;

class SyncArgosMonitoringVesselTracksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sousa:sync-argos-monitoring-vessel-tracks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch InitializeSynchronizeVesselTracksJob for Argos Monitoring';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        InitializeSynchronizeVesselTracksJob::dispatch();

        $this->info('InitializeSynchronizeVesselTracksJob has been dispatched.');

        return static::SUCCESS;
    }
}
