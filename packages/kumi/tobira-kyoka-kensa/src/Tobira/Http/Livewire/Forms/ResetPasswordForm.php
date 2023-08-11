<?php

namespace Kumi\Tobira\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Laravel\Fortify\Fortify;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Kumi\Tobira\Actions\Fortify\PasswordValidationRules;

class ResetPasswordForm extends Component implements HasForms
{
    use InteractsWithForms;
    use PasswordValidationRules;

    public $email;

    protected string $token;

    protected $queryString = ['email'];

    public function mount(string $token): void
    {
        $this->token = $token;

        $this->form->fill();
    }

    public function render(): View
    {
        return view('tobira::livewire.forms.reset-password', [
            'token' => $this->token,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make(Fortify::email())
                ->extraInputAttributes(['name' => Fortify::email(), 'readonly' => true])
                ->label(__('tobira::reset-password.fields.email.label'))
                ->email()
                ->default($this->email),
            Forms\Components\TextInput::make('password')
                ->extraInputAttributes(['name' => 'password'])
                ->label(__('tobira::reset-password.fields.password.label'))
                ->password()
                ->required()
                ->autofocus()
                ->rules($this->passwordRules()),
            Forms\Components\TextInput::make('password_confirmation')
                ->extraInputAttributes(['name' => 'password_confirmation'])
                ->label(__('tobira::reset-password.fields.password_confirmation.label'))
                ->password()
                ->required(),
        ];
    }
}
