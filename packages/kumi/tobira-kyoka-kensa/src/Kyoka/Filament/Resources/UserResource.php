<?php

namespace Kumi\Kyoka\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Kumi\Kyoka\Models\Role;
use Filament\Resources\Form;
use Kumi\Tobira\Models\User;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Kumi\Kyoka\Support\DefaultRoles;
use Illuminate\Database\Eloquent\Model;
use STS\FilamentImpersonate\Impersonate;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Kyoka\Support\DefaultPermissions;
use Kumi\Kyoka\Filament\Resources\UserResource\Pages;
use Kumi\Kyoka\Filament\Resources\UserResource\RelationManagers;
use Kumi\Kyoka\Filament\Resources\UserResource\Tables\Actions as ResourceActions;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'kyoka';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 9001;

    protected static ?string $slug = 'kyoka/users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->email()
                        ->unique(ignorable: fn (?Model $record): ?Model => $record),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required(function (Component $livewire): bool {
                            return $livewire instanceof Pages\CreateUser;
                        })
                        ->rules([new Password(), 'confirmed'])
                        ->hidden(function (Component $livewire): bool {
                            return $livewire instanceof Pages\ViewUser;
                        })
                        ->visible(function () {
                            return Auth::user()->can(DefaultPermissions::UPDATE_USER_PASSWORD);
                        }),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->password()
                        ->required(function (Component $livewire): bool {
                            return $livewire instanceof Pages\CreateUser;
                        })
                        ->hidden(function (Component $livewire): bool {
                            return $livewire instanceof Pages\ViewUser;
                        })
                        ->visible(function () {
                            return Auth::user()->can(DefaultPermissions::UPDATE_USER_PASSWORD);
                        }),
                ])->columnSpan(2),
                Forms\Components\Card::make([
                    Forms\Components\BelongsToManyCheckboxList::make('roles')
                        ->relationship('roles', 'label', function (Builder $query) {
                            return $query->whereNotIn('name', [
                                DefaultRoles::SUPER_ADMINISTRATOR,
                                DefaultRoles::SYSTEM,
                                DefaultRoles::BOT,
                            ]);
                        })
                        ->required()
                        ->default(function () {
                            $filament = Role::where('name', DefaultRoles::FILAMENT_USER)->first();

                            return [$filament->id];
                        }),
                ])->columnSpan(1),
            ])->columns(3)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('kyoka::filament/resources/user.columns.name.label'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('kyoka::filament/resources/user.columns.email.label'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\BooleanColumn::make('has_verified_email')
                    ->label(__('kyoka::filament/resources/user.columns.verified.label'))
                    ->getStateUsing(function (Model $record): string {
                        return $record->hasVerifiedEmail();
                    })
                    ->toggleable(),
                Tables\Columns\BooleanColumn::make('is_activated')
                    ->label(__('kyoka::filament/resources/user.columns.activated.label'))
                    ->getStateUsing(function (Model $record): string {
                        return $record->isActivated();
                    })
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('has_verified_email')
                    ->form([
                        Forms\Components\Select::make('has_verified_email')
                            ->label(__('kyoka::filament/resources/user/filters/has-verified-email.title'))
                            ->options([
                                'yes' => __('kyoka::filament/resources/user/filters/has-verified-email.fields.yes.label'),
                                'nope' => __('kyoka::filament/resources/user/filters/has-verified-email.fields.nope.label'),
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['has_verified_email'] === 'yes',
                                fn (Builder $query): Builder => $query->whereNotNull('email_verified_at'),
                            )
                            ->when(
                                $data['has_verified_email'] === 'nope',
                                fn (Builder $query): Builder => $query->whereNull('email_verified_at'),
                            )
                        ;
                    }),
                Filter::make('is_activated')
                    ->form([
                        Forms\Components\Select::make('is_activated')
                            ->label(__('kyoka::filament/resources/user/filters/is-activated.title'))
                            ->options([
                                'yes' => __('kyoka::filament/resources/user/filters/is-activated.fields.yes.label'),
                                'nope' => __('kyoka::filament/resources/user/filters/is-activated.fields.nope.label'),
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['is_activated'] === 'yes',
                                fn (Builder $query): Builder => $query->whereNotNull('activated_at'),
                            )
                            ->when(
                                $data['is_activated'] === 'nope',
                                fn (Builder $query): Builder => $query->whereNull('activated_at'),
                            )
                        ;
                    }),

            ])
            ->actions([
                Impersonate::make('impersonate'),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                ResourceActions\DeleteAction::make(),
            ])
            ->bulkActions([
                ResourceActions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->withoutSensitive();
    }
}
