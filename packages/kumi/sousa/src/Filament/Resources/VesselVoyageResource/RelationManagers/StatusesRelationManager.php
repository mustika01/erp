<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Kumi\Sousa\Filament\Fields\RadioButtonGroupField;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\Arrived;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\ConditionalArrival;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\ConditionalDeparture;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\Departed;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\FinishLoading;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\FinishUnloading;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\Moored;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\StartLoading;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\StartUnloading;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\Unmoored;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\WaitingForInstructions;
use Livewire\Component as Livewire;

class StatusesRelationManager extends RelationManager
{
    protected static string $relationship = 'statuses';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                RadioButtonGroupField::make('description')
                    ->label(__('sousa::filament/resources/voyage-status.fields.description.label'))
                    ->options(function (Livewire $livewire) {
                        $voyage = $livewire->getOwnerRecord();

                        if ($voyage->is_returning) {
                            return [
                                VoyageState::UNMOORED => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::UNMOORED),
                                VoyageState::DEPARTED => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::DEPARTED),
                                VoyageState::ARRIVED => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::ARRIVED),
                                VoyageState::MOORED => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::MOORED),
                            ];
                        }

                        return [
                            VoyageState::START_LOADING => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::START_LOADING),
                            VoyageState::FINISH_LOADING => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::FINISH_LOADING),
                            VoyageState::UNMOORED => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::UNMOORED),
                            VoyageState::DEPARTED => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::DEPARTED),
                            VoyageState::ARRIVED => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::ARRIVED),
                            VoyageState::MOORED => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::MOORED),
                            VoyageState::START_UNLOADING => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::START_UNLOADING),
                            VoyageState::FINISH_UNLOADING => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::FINISH_UNLOADING),
                            VoyageState::CONDITIONAL_DEPARTURE => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::CONDITIONAL_DEPARTURE),
                            VoyageState::CONDITIONAL_ARRIVAL => __('sousa::filament/resources/voyage-status.fields.description.options.' . VoyageState::CONDITIONAL_ARRIVAL),
                        ];
                    })
                    ->disableOptionWhen(function ($value, $label, Livewire $livewire, string $context) {
                        if ($context === 'edit') {
                            return true;
                        }

                        $voyage = $livewire->getOwnerRecord();

                        return match ($value) {
                            VoyageState::START_LOADING => ! $voyage->status->canTransitionTo(StartLoading::class),
                            VoyageState::FINISH_LOADING => ! $voyage->status->canTransitionTo(FinishLoading::class),
                            VoyageState::UNMOORED => ! $voyage->status->canTransitionTo(Unmoored::class),
                            VoyageState::DEPARTED => ! $voyage->status->canTransitionTo(Departed::class),
                            VoyageState::ARRIVED => ! $voyage->status->canTransitionTo(Arrived::class),
                            VoyageState::MOORED => ! $voyage->status->canTransitionTo(Moored::class),
                            VoyageState::START_UNLOADING => ! $voyage->status->canTransitionTo(StartUnloading::class),
                            VoyageState::FINISH_UNLOADING => ! $voyage->status->canTransitionTo(FinishUnloading::class),
                            VoyageState::CONDITIONAL_DEPARTURE => ! $voyage->status->canTransitionTo(ConditionalDeparture::class),
                            VoyageState::CONDITIONAL_ARRIVAL => ! $voyage->status->canTransitionTo(ConditionalArrival::class),
                            default => true,
                        };
                    })
                    ->required()
                    ->columns(2)
                    ->columnSpan(2)
                    ->disabled(function ($context) {
                        return $context === 'edit';
                    }),
                Forms\Components\Group::make([
                    Forms\Components\DateTimePicker::make('executed_at')
                        ->label(__('sousa::filament/resources/voyage-status.fields.executed_at.label'))
                        ->withoutSeconds()
                        ->displayFormat('d F Y / H:i')
                        ->required(),
                    Forms\Components\Textarea::make('remarks')
                        ->label(__('sousa::filament/resources/voyage-status.fields.remarks.label')),
                ]),
            ])->columns(3)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('executed_date')
                    ->label(__('sousa::filament/resources/voyage-status.columns.executed_date.label')),
                Tables\Columns\TextColumn::make('executed_time')
                    ->label(__('sousa::filament/resources/voyage-status.columns.executed_time.label')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('sousa::filament/resources/voyage-status.columns.description.label'))
                    ->formatStateUsing(function (string $state) {
                        return __('sousa::filament/resources/voyage-status.columns.description.options.' . $state);
                    }),
                Tables\Columns\TextColumn::make('remarks')
                    ->label(__('sousa::filament/resources/voyage-status.columns.remarks.label')),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->disableCreateAnother()
                    ->after(function (Model $record) {
                        $stateMappings = [
                            VoyageState::START_LOADING => StartLoading::class,
                            VoyageState::FINISH_LOADING => FinishLoading::class,
                            VoyageState::UNMOORED => Unmoored::class,
                            VoyageState::DEPARTED => Departed::class,
                            VoyageState::ARRIVED => Arrived::class,
                            VoyageState::MOORED => Moored::class,
                            VoyageState::START_UNLOADING => StartUnloading::class,
                            VoyageState::FINISH_UNLOADING => FinishUnloading::class,
                            VoyageState::CONDITIONAL_DEPARTURE => ConditionalDeparture::class,
                            VoyageState::CONDITIONAL_ARRIVAL => ConditionalArrival::class,
                        ];

                        $state = $stateMappings[$record->description];

                        $record->voyage->status->transitionTo($state);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(function (Model $record) {
                        return $record->isDeletable();
                    })
                    ->after(function (Livewire $livewire) {
                        $voyage = $livewire->getOwnerRecord();
                        $latestStatus = $voyage->latestStatus;

                        if (! $latestStatus) {
                            $voyage->status = WaitingForInstructions::class;
                            $voyage->save();

                            return;
                        }

                        $stateMappings = [
                            VoyageState::START_LOADING => StartLoading::class,
                            VoyageState::FINISH_LOADING => FinishLoading::class,
                            VoyageState::UNMOORED => Unmoored::class,
                            VoyageState::DEPARTED => Departed::class,
                            VoyageState::ARRIVED => Arrived::class,
                            VoyageState::MOORED => Moored::class,
                            VoyageState::START_UNLOADING => StartUnloading::class,
                            VoyageState::FINISH_UNLOADING => FinishUnloading::class,
                            VoyageState::CONDITIONAL_DEPARTURE => ConditionalDeparture::class,
                            VoyageState::CONDITIONAL_ARRIVAL => ConditionalArrival::class,
                        ];

                        $voyage->status = $stateMappings[$latestStatus->description];
                        $voyage->save();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    protected function getTableQuery(): Builder|Relation
    {
        return parent::getTableQuery()->oldest();
    }
}
