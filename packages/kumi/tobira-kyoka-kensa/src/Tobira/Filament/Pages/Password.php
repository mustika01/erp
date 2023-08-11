<?php

namespace Kumi\Tobira\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Kumi\Tobira\Models\User;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Auth;
use Kumi\Tobira\Support\DefaultPermissions;
use Illuminate\Contracts\Auth\StatefulGuard;
use Kumi\Tobira\Actions\CompletePasswordUpdate;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Rules\Password as PasswordRule;

class Password extends Page
{
    public $data;

    public User $user;

    protected static ?string $navigationGroup = 'tobira';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 8002;

    protected static ?string $slug = 'tobira/password';

    protected static string $view = 'tobira::filament.pages.password';

    protected static string|array $middlewares = [
        'can:' . DefaultPermissions::MANAGE_PASSWORD,
    ];

    public function mount(StatefulGuard $guard): void
    {
        $this->user = $guard->user();

        $this->form->fill([
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]);
    }

    public function update(UpdatesUserPasswords $updater): void
    {
        $data = $this->form->getState();

        $updater->update($this->user, $data);

        CompletePasswordUpdate::dispatch($this->user, $data);

        // @codeCoverageIgnoreStart
        if (request()->hasSession()) {
            request()->session()->put([
                'password_hash_' . Auth::getDefaultDriver() => $this->user->getAuthPassword(),
            ]);
        }
        // @codeCoverageIgnoreEnd

        $this->notify('success', __('tobira::password.messages.saved'));

        $this->redirectRoute('filament.pages.tobira/password');
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()
                ->schema([
                    Forms\Components\TextInput::make('current_password')
                        ->password()
                        ->required()
                        ->autofocus()
                        ->currentPassword(),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->rules([new PasswordRule(), 'confirmed']),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->password()
                        ->required(),
                ]),
        ];
    }

    protected function getFormModel(): User
    {
        return $this->user;
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::MANAGE_PASSWORD);
    }
}
