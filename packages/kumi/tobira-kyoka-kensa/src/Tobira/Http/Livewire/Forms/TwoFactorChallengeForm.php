<?php

namespace Kumi\Tobira\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class TwoFactorChallengeForm extends Component implements HasForms
{
    use InteractsWithForms;

    public function render(): View
    {
        return view('tobira::livewire.forms.two-factor-challenge');
    }

    protected function getCodeFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('code')
                ->extraInputAttributes(['name' => 'code'])
                ->label(__('tobira::two-factor-authentication/challenge.fields.code.label'))
                ->autofocus()
                ->autocomplete(),
        ];
    }

    protected function getRecoveryFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('recovery_code')
                ->extraInputAttributes(['name' => 'recovery_code'])
                ->label(__('tobira::two-factor-authentication/challenge.fields.recovery.label'))
                ->autofocus()
                ->autocomplete(),
        ];
    }

    protected function getForms(): array
    {
        return [
            'codeForm' => $this->makeForm()
                ->schema($this->getCodeFormSchema()),
            'recoveryForm' => $this->makeForm()
                ->schema($this->getRecoveryFormSchema()),
        ];
    }
}
