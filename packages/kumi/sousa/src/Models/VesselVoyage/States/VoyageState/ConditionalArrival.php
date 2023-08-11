<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class ConditionalArrival extends VoyageState
{
    public function status(): string
    {
        return self::CONDITIONAL_ARRIVAL;
    }
}
