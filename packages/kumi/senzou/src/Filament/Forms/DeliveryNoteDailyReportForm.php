<?php

namespace Kumi\Senzou\Filament\Forms;

use Filament\Forms;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Kumi\Senzou\Filament\Pages\DeliveryNoteDailyReport;
use Livewire\Component;

class DeliveryNoteDailyReportForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $date;

    protected $queryString = ['date'];

    public function mount()
    {
        $this->date ??= Carbon::now()->toDateString();
    }

    public function render(): View
    {
        return view('senzou::filament.forms.delivery-note-daily-report');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make([
                Forms\Components\DatePicker::make('date')
                    ->default($this->date)
                    ->displayFormat('d F Y')
                    ->closeOnDateSelection()
                    ->reactive()
                    ->afterStateUpdated(function (string $state) {
                        return redirect()->to(DeliveryNoteDailyReport::getUrl([
                            'date' => Carbon::parse($state)->toDateString(),
                        ]));
                    }),
            ]),
        ];
    }
}
