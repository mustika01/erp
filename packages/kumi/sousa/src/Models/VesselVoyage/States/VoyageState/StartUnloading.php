<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class StartUnloading extends VoyageState
{
    public function status(): string
    {
        return self::START_UNLOADING;
    }
}
