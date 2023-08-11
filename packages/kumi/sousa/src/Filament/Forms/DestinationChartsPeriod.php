<?php

namespace Kumi\Sousa\Filament\Forms;

use Filament\Forms;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Filament\Fields\RadioButtonGroupField;
use Kumi\Sousa\Filament\Widgets\DestinationVesselStatusesWidget;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\FinishUnloading;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Livewire\Component as Livewire;

class DestinationChartsPeriod extends Livewire implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public string $widgetClass = DestinationVesselStatusesWidget::class;

    public string $started_at;
    public string $ended_at;
    public string $voyage_status;

    public Collection $destinationPortIds;

    public function mount(): void
    {
        $this->form->fill([
            'started_at' => Carbon::now()->subMonth()->startOfDay(),
            'ended_at' => Carbon::now()->endOfDay(),
            'voyage_status' => VoyageState::FINISH_UNLOADING,
        ]);

        $this->destinationPortIds = new Collection();
    }

    public function render(): View
    {
        return view('sousa::filament.forms.destination-charts-period');
    }

    public function submit(): void
    {
        $this->destinationPortIds = $this->compileDestinationPortIds();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make([
                Forms\Components\DatePicker::make('started_at')
                    ->label(__('sousa::filament/widgets/destination-chart.forms.started_at.label'))
                    ->displayFormat('d F Y')
                    ->closeOnDateSelection()
                    ->required(),
                Forms\Components\DatePicker::make('ended_at')
                    ->label(__('sousa::filament/widgets/destination-chart.forms.ended_at.label'))
                    ->displayFormat('d F Y')
                    ->closeOnDateSelection()
                    ->required(),
                RadioButtonGroupField::make('voyage_status')
                    ->label(__('sousa::filament/widgets/destination-chart.forms.voyage_status.label'))
                    ->options([
                        VoyageState::START_LOADING => __('sousa::filament/widgets/destination-chart.forms.voyage_status.options.' . VoyageState::START_LOADING),
                        VoyageState::FINISH_UNLOADING => __('sousa::filament/widgets/destination-chart.forms.voyage_status.options.' . VoyageState::FINISH_UNLOADING),
                    ])
                    ->columns(2),
            ])->columns(3),
        ];
    }

    protected function compileDestinationPortIds(): Collection
    {
        $destinationPortIds = VesselVoyage::query()
            ->whereState('status', FinishUnloading::class)
            ->whereHas('statuses', function (Builder $query) {
                $query->whereBetween('executed_at', [$this->started_at, $this->ended_at]);
            })
            ->pluck('destination_port_id')
        ;

        return Collection::make($destinationPortIds)
            ->unique()
        ;
    }
}
