<?php

namespace Kumi\Norikumi\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Kumi\Norikumi\Models\RegistrationFormEntry;

class PINCodeForm extends Component implements HasForms
{
    use InteractsWithForms;

    public RegistrationFormEntry $entry;

    public function mount(RegistrationFormEntry $entry): void
    {
        $this->entry = $entry;

        $this->form->fill();
    }

    public function render(): View
    {
        return view('norikumi::livewire.forms.pin-code');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('pin_code')
                ->extraInputAttributes(['name' => 'pin_code'])
                ->label(__('norikumi::filament/resources/registration-form-entry.fields.pin_code.label'))
                ->required()
                ->autofocus(),
        ];
    }
}
