<?php

namespace Kumi\Jinzai\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Kumi\Jinzai\Models\OnboardingLink;
use Filament\Forms\Concerns\InteractsWithForms;

class OnboardingForm extends Component implements HasForms
{
    use InteractsWithForms;

    public OnboardingLink $link;

    public function mount(OnboardingLink $link): void
    {
        $this->link = $link;

        $this->form->fill();
    }

    public function render(): View
    {
        return view('jinzai::livewire.forms.onboarding', []);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->extraInputAttributes(['name' => 'name'])
                ->label(__('jinzai::filament/resources/onboarding-link.fields.name.label'))
                ->required()
                ->autocomplete()
                ->autofocus(function () {
                    return ! old('name');
                })
                ->default(old('name')),
            Forms\Components\TextInput::make('password')
                ->extraInputAttributes(['name' => 'password'])
                ->label(__('jinzai::filament/resources/onboarding-link.fields.password.label'))
                ->password()
                ->required(),
            Forms\Components\TextInput::make('password_confirmation')
                ->extraInputAttributes(['name' => 'password_confirmation'])
                ->label(__('jinzai::filament/resources/onboarding-link.fields.password_confirmation.label'))
                ->password()
                ->required(),
        ];
    }
}
