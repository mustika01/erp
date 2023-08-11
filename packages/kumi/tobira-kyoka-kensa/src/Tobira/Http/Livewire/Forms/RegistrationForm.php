<?php

namespace Kumi\Tobira\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Kumi\Tobira\Actions\Fortify\PasswordValidationRules;

class RegistrationForm extends Component implements HasForms
{
    use InteractsWithForms;
    use PasswordValidationRules;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function render(): View
    {
        return view('tobira::livewire.forms.registration');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->extraInputAttributes(['name' => 'name'])
                ->label(__('tobira::registration.fields.name.label'))
                ->required()
                ->autocomplete()
                ->autofocus(function () {
                    return ! old('name');
                })
                ->default(old('name')),
            Forms\Components\TextInput::make('email')
                ->extraInputAttributes(['name' => 'email'])
                ->label(__('tobira::registration.fields.email.label'))
                ->email()
                ->required()
                ->autocomplete()
                ->autofocus(function () {
                    return ! old('email');
                })
                ->default(old('email')),
            Forms\Components\TextInput::make('password')
                ->extraInputAttributes(['name' => 'password'])
                ->label(__('tobira::registration.fields.password.label'))
                ->password()
                ->required()
                ->autofocus(function () {
                    return (bool) old('name') && (bool) old('email');
                })
                ->rules($this->passwordRules()),
            Forms\Components\TextInput::make('password_confirmation')
                ->extraInputAttributes(['name' => 'password_confirmation'])
                ->label(__('tobira::registration.fields.password_confirmation.label'))
                ->password()
                ->required(),
        ];
    }
}
