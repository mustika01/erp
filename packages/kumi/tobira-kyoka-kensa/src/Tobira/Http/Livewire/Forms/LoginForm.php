<?php

namespace Kumi\Tobira\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Filament\Forms\Components\Grid;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class LoginForm extends Component implements HasForms
{
    use InteractsWithForms;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function render(): View
    {
        return view('tobira::livewire.forms.login');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make(Fortify::email())
                ->extraInputAttributes(['name' => Fortify::email()])
                ->label(__('tobira::login.fields.email.label'))
                ->email()
                ->required()
                ->autofocus()
                ->autocomplete()
                ->default(old(Fortify::email())),
            Forms\Components\TextInput::make('password')
                ->extraInputAttributes(['name' => 'password'])
                ->label(__('tobira::login.fields.password.label'))
                ->password()
                ->required(),
            Grid::make()
                ->schema([
                    Forms\Components\Checkbox::make('remember')
                        ->extraInputAttributes(['name' => 'remember'])
                        ->label(__('tobira::login.fields.remember.label')),
                    Forms\Components\View::make('forgot-password')
                        ->view('tobira::livewire.forms.login.forgot-password-link')
                        ->visible(Features::enabled(Features::resetPasswords())),
                ]),
        ];
    }
}
