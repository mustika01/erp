<?php

namespace Kumi\Kanshi\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Kumi\Kanshi\Models\Activity;
use Illuminate\Support\Collection;
use Livewire\Component as Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kanshi\Support\DefaultPermissions;
use Kumi\Kanshi\Filament\Resources\ActivityResource\Pages;
use Kumi\Kanshi\Filament\Resources\ActivityResource\Pages\ViewActivity;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationGroup = 'kanshi';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 10001;

    protected static ?string $slug = 'kanshi/activities';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\DatePicker::make('created_at')
                            ->label(__('kanshi::filament/resources/activity.fields.created_date.label'))
                            ->displayFormat('d M Y'),
                        Forms\Components\TimePicker::make('created_at')
                            ->label(__('kanshi::filament/resources/activity.fields.created_time.label')),
                        Forms\Components\Grid::make(1)
                            ->relationship('subject')
                            ->schema([
                                Forms\Components\TextInput::make('subject_name')
                                    ->label(__('kanshi::filament/resources/activity.fields.subject.label'))
                                    ->afterStateHydrated(function (Closure $set, ?Model $record, Livewire $livewire) {
                                        if ($livewire instanceof ViewActivity) {
                                            $set('subject_name', $record->activity_log_name);
                                        }
                                    }),
                            ])
                            ->columnSpan(1),
                        Forms\Components\Grid::make(1)
                            ->relationship('causer')
                            ->schema([
                                Forms\Components\TextInput::make('causer_name')
                                    ->label(__('kanshi::filament/resources/activity.fields.subject.label'))
                                    ->afterStateHydrated(function (Closure $set, ?Model $record, Livewire $livewire) {
                                        if ($livewire instanceof ViewActivity) {
                                            $set('causer_name', $record->activity_log_name);
                                        }
                                    }),
                            ])
                            ->columnSpan(1),
                        Forms\Components\Textarea::make('description')
                            ->label(__('kanshi::filament/resources/activity.fields.description.label'))
                            ->columnSpan(4),
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
                            ->visible(function () {
                                return Auth::user()->can(DefaultPermissions::VIEW_ACTIVITY_DETAILS);
                            }),
                    ])
                    ->columns(4),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_date')
                    ->label(__('kanshi::filament/resources/activity.columns.created_date.label')),
                Tables\Columns\TextColumn::make('created_time')
                    ->label(__('kanshi::filament/resources/activity.columns.created_time.label')),
                Tables\Columns\TextColumn::make('subject.activity_log_name')
                    ->label(__('kanshi::filament/resources/activity.columns.subject.label'))
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

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'view' => Pages\ViewActivity::route('/{record}'),
        ];
    }
}
