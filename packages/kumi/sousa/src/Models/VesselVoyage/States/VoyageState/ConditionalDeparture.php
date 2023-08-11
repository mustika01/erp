<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class ConditionalDeparture extends VoyageState
{
    public function status(): string
    {
        return self::CONDITIONAL_DEPARTURE;
    }
}
