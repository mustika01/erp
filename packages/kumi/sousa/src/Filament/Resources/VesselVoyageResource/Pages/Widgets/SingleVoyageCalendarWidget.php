<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets;

use Kumi\Sousa\Models\CargoLog;
use Illuminate\Support\Collection;
use Kumi\Sousa\Models\VoyageStatus;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Widgets\Concerns\CantManageEvents;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;

class SingleVoyageCalendarWidget extends FullCalendarWidget
{
    use CantManageEvents;

    public ?Model $record = null;

    /**
     * Return events that should be rendered statically on calendar.
     */
    public function getViewData(): array
    {
        $events = new Collection();
        $statusEvents = $this->getStatusEvents();
        $loadingEvents = $this->getLoadingEvents();
        $unloadingEvents = $this->getUnloadingEvents();

        $events = $events->merge($statusEvents);
        $events = $events->merge($loadingEvents);
        $events = $events->merge($unloadingEvents);

        $earliestEvent = $events->sortBy(function (array $event) {
            return $event['start'];
        })->first();

        if ($earliestEvent) {
            $this->fullCalendarConfig['initialDate'] = $earliestEvent['start'];
        }

        return $events->toArray();
    }

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        return [];
    }

    public static function canView(?array $event = null): bool
    {
        // When event is null, MAKE SURE you allow View otherwise the entire widget/calendar won't be rendered
        if ($event === null) {
            return true;
        }

        // Returning 'false' will not show the event Modal.
        return false;
    }

    protected function getStatusEvents(): Collection
    {
        $statuses = $this->record->statuses->sortBy('executed_at')->values();

        return $statuses->map(function (VoyageStatus $status, int $index) use ($statuses) {
            $eventColorMappings = [
                VoyageState::START_LOADING => 'darkblue',
                VoyageState::FINISH_LOADING => 'darkblue',
                VoyageState::UNMOORED => 'darkgreen',
                VoyageState::DEPARTED => 'darkgreen',
                VoyageState::ARRIVED => 'crimson',
                VoyageState::MOORED => 'crimson',
                VoyageState::START_UNLOADING => 'blue',
                VoyageState::FINISH_UNLOADING => 'blue',
                VoyageState::CONDITIONAL_DEPARTURE => 'pink',
                VoyageState::CONDITIONAL_ARRIVAL => 'pink',
            ];

            if (isset($statuses[$index + 1])) {
                $end = $statuses[$index + 1]->executed_at->subDay()->endOfDay();
            } else {
                $end = $status->executed_at->endOfDay();
            }

            $collection = Collection::make();

            $collection->push([
                'id' => 'A' . $status->id,
                'title' => __('sousa::filament/resources/voyage-status.columns.description.options.' . $status->description),
                'start' => $status->executed_at,
                'end' => $end,
                'color' => $eventColorMappings[$status->description],
            ]);

            if ($index === 0) {
                $collection->push([
                    'id' => 'D' . $status->id,
                    'title' => $this->record->is_returning ? '' : 'Voy ' . $this->record->number,
                    'start' => $status->executed_at,
                    'end' => $statuses[$statuses->count() - 1]->executed_at->addDay()->endOfDay(),
                    'allDay' => true,
                    'classNames' => $this->record->is_returning
                        ? '!bg-yellow-200 !text-gray-900'
                        : '!bg-green-200 !text-gray-900',
                    'display' => 'background',
                ]);
            }

            return $collection;
        })->flatten(1);
    }

    protected function getLoadingEvents(): Collection
    {
        return $this->record->loadingCargoLogs->map(function (CargoLog $log) {
            return [
                'id' => 'B' . $log->id,
                'title' => __('sousa::filament/resources/vessel-voyage.calendar.loading', ['tonnage_amount' => $log->tonnage_amount_formatted]),
                'start' => $log->executed_at,
                'end' => $log->executed_at,
                'color' => 'lime',
            ];
        });
    }

    protected function getUnloadingEvents(): Collection
    {
        return $this->record->unloadingCargoLogs->map(function (CargoLog $log) {
            return [
                'id' => 'C' . $log->id,
                'title' => __('sousa::filament/resources/vessel-voyage.calendar.unloading', ['tonnage_amount' => $log->tonnage_amount_formatted]),
                'start' => $log->executed_at,
                'end' => $log->executed_at,
                'color' => 'red',
            ];
        });
    }
}
