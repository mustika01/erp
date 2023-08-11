<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets;

use Kumi\Sousa\Models\VesselVoyage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class VoyageStatsWidget extends BaseWidget
{
    public ?Model $record = null;

    protected int|string|array $columnSpan = '1';

    public static function canView(): bool
    {
        $voyage = VesselVoyage::find(Session::get('current_voyage_id'));

        return $voyage ? ! $voyage->is_returning : false;
    }

    protected function getCards(): array
    {
        $totalLoadingCargoLogs = $this->record->loadingCargoLogs->sum('tonnage_amount');
        $totalLoadingFormatted = number_format($totalLoadingCargoLogs, 2);
        $totalUnloadingCargoLogs = $this->record->unloadingCargoLogs->sum('tonnage_amount');
        $totalUnloadingFormatted = number_format($totalUnloadingCargoLogs, 2);
        $difference = $totalLoadingCargoLogs - $totalUnloadingCargoLogs;
        $differenceFormatted = number_format($difference, 2);

        return [
            Card::make('Tonnage Loaded', $totalLoadingFormatted . ' t')
                ->color('success'),
            Card::make('Tonnage Unloaded', $totalUnloadingFormatted . ' t')
                ->color('danger'),
            Card::make('Difference', $differenceFormatted . ' t'),
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }
}
