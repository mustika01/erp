<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class Unmoored extends VoyageState
{
    public function status(): string
    {
        return self::UNMOORED;
    }
}
