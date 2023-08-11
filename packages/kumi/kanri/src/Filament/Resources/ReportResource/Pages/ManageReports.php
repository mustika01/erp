<?php

namespace Kumi\Kanri\Filament\Resources\ReportResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ManageRecords;
use Kumi\Kanri\Filament\Resources\ReportResource;

class ManageReports extends ManageRecords
{
    protected static string $resource = ReportResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->disableCreateAnother()
                ->mutateFormDataUsing(function (array $data): array {
                    switch ($data['reportable_type']) {
                        case \Kumi\Jinzai\Models\Payout::class:
                            $date = Carbon::parse($data['year'] . ' ' . $data['month']);

                            $data['started_at'] = $date->copy()->startOfMonth()->startOfDay();
                            $data['finalized_at'] = $date->copy()->endOfMonth()->endOfDay();

                            break;

                        case 'docking-schedule':
                            $date = Carbon::parse($data['year']);

                            $data['started_at'] = $date->copy()->startOfYear()->startOfDay();
                            $data['finalized_at'] = $date->copy()->endOfYear()->endOfDay();

                            break;

                        case \Kumi\Sousa\Models\VesselVoyage::class:
                            $date = Carbon::parse($data['year'] . ' ' . $data['month']);

                            $data['started_at'] = $date->copy()->startOfMonth()->startOfDay();
                            $data['finalized_at'] = $date->copy()->endOfMonth()->endOfDay();

                            break;

                        default:
                            break;
                    }

                    unset($data['year'], $data['month']);

                    $data['user_id'] = Auth::user()->id;

                    return $data;
                }),
        ];
    }
}
