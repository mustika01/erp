<?php

namespace Kumi\Tobira\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class ConfirmPasswordForm extends Component implements HasForms
{
    use InteractsWithForms;

    public function render(): View
    {
        return view('tobira::livewire.forms.confirm-password');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('password')
                ->extraInputAttributes(['name' => 'password'])
                ->label(__('tobira::confirm-password.fields.password.label'))
                ->password()
                ->required()
                ->autofocus(),
        ];
    }
}
