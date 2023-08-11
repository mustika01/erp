<?php

namespace Kumi\Tobira\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Laravel\Fortify\Fortify;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class ForgotPasswordForm extends Component implements HasForms
{
    use InteractsWithForms;

    public function render(): View
    {
        return view('tobira::livewire.forms.forgot-password');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make(Fortify::email())
                ->extraInputAttributes(['name' => Fortify::email()])
                ->label(__('tobira::forgot-password.fields.email.label'))
                ->email()
                ->required()
                ->autocomplete()
                ->autofocus()
                ->helperText(__('tobira::forgot-password.fields.email.helper-text')),
        ];
    }
}
