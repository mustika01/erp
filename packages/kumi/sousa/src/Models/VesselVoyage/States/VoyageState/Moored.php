<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class Moored extends VoyageState
{
    public function status(): string
    {
        return self::MOORED;
    }
}
