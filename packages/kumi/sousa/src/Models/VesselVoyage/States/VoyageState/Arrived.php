<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class Arrived extends VoyageState
{
    public function status(): string
    {
        return self::ARRIVED;
    }
}
