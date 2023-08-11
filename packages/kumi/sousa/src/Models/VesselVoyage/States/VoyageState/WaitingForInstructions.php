<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class WaitingForInstructions extends VoyageState
{
    public function status(): string
    {
        return self::WAITING_FOR_INSTRUCTIONS;
    }
}
