<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

class FinishLoading extends VoyageState
{
    public function status(): string
    {
        return self::FINISH_LOADING;
    }
}
