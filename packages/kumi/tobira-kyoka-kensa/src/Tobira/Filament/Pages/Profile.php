<?php

namespace Kumi\Tobira\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Kumi\Tobira\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kumi\Tobira\Support\DefaultPermissions;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class Profile extends Page
{
    public $data;

    public User $user;

    protected static ?string $navigationGroup = 'tobira';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 8001;

    protected static ?string $slug = 'tobira/profile';

    protected static string $view = 'tobira::filament.pages.profile';

    protected static string|array $middlewares = [
        'can:' . DefaultPermissions::MANAGE_PROFILE,
    ];

    public function mount(StatefulGuard $guard): void
    {
        $this->user = $guard->user();

        $this->form->fill([
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]);
    }

    public function update(UpdatesUserProfileInformation $updater): void
    {
        $data = $this->form->getState();

        $updater->update($this->user, $data);

        $this->notify('success', __('tobira::profile.messages.saved'));
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()
                ->schema([
                    View::make('tobira::filament.forms.layouts.section')
                        ->extraAttributes([
                            'class' => 'flex items-center justify-center h-full',
                        ])
                        ->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                                ->avatar(),
                        ]),
                    Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->autofocus(),
                            Forms\Components\TextInput::make('email')
                                ->required()
                                ->email()
                                ->unique(ignorable: fn (?Model $record): ?Model => $record),
                        ])
                        ->columns(1)
                        ->columnSpan(2),
                ])
                ->columns(3),
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
        return Auth::user()->can(DefaultPermissions::MANAGE_PROFILE);
    }
}
