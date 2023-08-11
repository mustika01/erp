<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class StartLoading extends VoyageState
{
    public function status(): string
    {
        return self::START_LOADING;
    }
}
