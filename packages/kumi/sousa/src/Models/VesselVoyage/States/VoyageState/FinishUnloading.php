<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class FinishUnloading extends VoyageState
{
    public function status(): string
    {
        return self::FINISH_UNLOADING;
    }
}
