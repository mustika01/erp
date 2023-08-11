<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class WaitingForDeparture extends VoyageState
{
    public function status(): string
    {
        return self::WAITING_FOR_DEPARTURE;
    }
}
