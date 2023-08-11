<?php

namespace Kumi\Sousa\Models\VesselVoyage\States\VoyageState;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class VoyageState extends State
{
    public const WAITING_FOR_INSTRUCTIONS = 'waiting-for-instructions';
    public const WAITING_FOR_DEPARTURE = 'waiting-for-departure';
    public const START_LOADING = 'start-loading';
    public const FINISH_LOADING = 'finish-loading';
    public const UNMOORED = 'unmoored';
    public const DEPARTED = 'departed';
    public const ARRIVED = 'arrived';
    public const MOORED = 'moored';
    public const START_UNLOADING = 'start-unloading';
    public const FINISH_UNLOADING = 'finish-unloading';
    public const CONDITIONAL_DEPARTURE = 'conditional-departure';
    public const CONDITIONAL_ARRIVAL = 'conditional-arrival';

    abstract public function status(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(WaitingForInstructions::class)
            ->allowTransitions([
                [WaitingForInstructions::class, StartLoading::class],
                [StartLoading::class, FinishLoading::class],
                [[WaitingForDeparture::class, FinishLoading::class], Unmoored::class],
                [[WaitingForDeparture::class, FinishLoading::class, Unmoored::class], Departed::class],
                [Departed::class, Arrived::class],
                [Arrived::class, Moored::class],
                [[Arrived::class, Moored::class, ConditionalArrival::class], StartUnloading::class],
                [StartUnloading::class, FinishUnloading::class],
                [FinishUnloading::class, ConditionalDeparture::class],
                [ConditionalDeparture::class, ConditionalArrival::class],
            ])
        ;
    }
}
