<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class Departed extends VoyageState
{
    public function status(): string
    {
        return self::DEPARTED;
    }
}
