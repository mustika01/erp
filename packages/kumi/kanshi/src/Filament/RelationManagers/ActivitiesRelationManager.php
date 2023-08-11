<?php

namespace Kumi\Kanshi\Filament\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Collection;
use Livewire\Component as Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kanshi\Support\DefaultPermissions;
use Filament\Resources\RelationManagers\RelationManager;

/**
 * @codeCoverageIgnore
 */
class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'activities';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\DatePicker::make('created_at')
                            ->label(__('kanshi::filament/resources/activity.fields.created_date.label'))
                            ->displayFormat('d M Y'),
                        Forms\Components\TimePicker::make('created_at')
                            ->label(__('kanshi::filament/resources/activity.fields.created_time.label')),
                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\TextInput::make('causer_name')
                                    ->label(__('kanshi::filament/resources/activity.fields.causer.label'))
                                    ->afterStateHydrated(function (Closure $set, ?Model $record) {
                                        $set('causer_name', optional($record->causer)->activity_log_name);
                                    }),
                            ])
                            ->columnSpan(2),
                        Forms\Components\Textarea::make('description')
                            ->label(__('kanshi::filament/resources/activity.fields.description.label'))
                            ->columnSpan(4),
                    ])
                    ->disabled(),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\KeyValue::make('properties.old')
                            ->label(__('kanshi::filament/resources/activity.fields.previous.label'))
                            ->reactive()
                            ->afterStateHydrated(function (Closure $set, $state) {
                                $state = Collection::make($state)
                                    ->reject(function ($value, $key) {
                                        return in_array($key, ['updated_at', 'password', 'remember_token']);
                                    })
                                    ->mapWithKeys(function ($value, $key) {
                                        return [Str::headline($key) => $value];
                                    })
                                ;

                                $set('properties.old', $state);
                            }),
                        Forms\Components\KeyValue::make('properties.attributes')
                            ->label(__('kanshi::filament/resources/activity.fields.updates.label'))
                            ->reactive()
                            ->afterStateHydrated(function (Closure $set, $state) {
                                $state = Collection::make($state)
                                    ->reject(function ($value, $key) {
                                        return in_array($key, ['updated_at', 'password', 'remember_token']);
                                    })
                                    ->mapWithKeys(function ($value, $key) {
                                        return [Str::headline($key) => $value];
                                    })
                                ;

                                $set('properties.attributes', $state);
                            }),
                    ])
                    ->visible(fn (Livewire $livewire): bool => $livewire->checkActivityDetailsPermission()),

            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_date')
                    ->label(__('kanshi::filament/resources/activity.columns.created_date.label'))
                    ->searchable(['created_at'])
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_time')
                    ->label(__('kanshi::filament/resources/activity.columns.created_time.label'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('causer.activity_log_name')
                    ->label(__('kanshi::filament/resources/activity.columns.causer.label'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('kanshi::filament/resources/activity.columns.description.label'))
                    ->searchable(),
            ])
            ->filters([

            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
        ;
    }

    protected function checkActivityDetailsPermission(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_ACTIVITY_DETAILS);
    }
}
