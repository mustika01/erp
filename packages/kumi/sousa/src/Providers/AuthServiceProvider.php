<?php

namespace Kumi\Sousa\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Models\BunkerFormula;
use Kumi\Sousa\Models\BunkerJournal;
use Kumi\Sousa\Models\OilJournal;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VesselDocument;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Models\VoyageStatus;
use Kumi\Sousa\Policies\BunkerFormulaPolicy;
use Kumi\Sousa\Policies\BunkerJournalPolicy;
use Kumi\Sousa\Policies\BunkerPolicy;
use Kumi\Sousa\Policies\OilJournalPolicy;
use Kumi\Sousa\Policies\VesselDocumentPolicy;
use Kumi\Sousa\Policies\VesselPolicy;
use Kumi\Sousa\Policies\VesselVoyagePolicy;
use Kumi\Sousa\Policies\VoyageStatusPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Vessel::class => VesselPolicy::class,
        VesselDocument::class => VesselDocumentPolicy::class,
        VesselVoyage::class => VesselVoyagePolicy::class,
        VoyageStatus::class => VoyageStatusPolicy::class,
        Bunker::class => BunkerPolicy::class,
        BunkerFormula::class => BunkerFormulaPolicy::class,
        BunkerJournal::class => BunkerJournalPolicy::class,
        OilJournal::class => OilJournalPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
