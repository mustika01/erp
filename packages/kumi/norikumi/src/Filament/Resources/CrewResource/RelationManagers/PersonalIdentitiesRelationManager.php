<?php

namespace Kumi\Norikumi\Filament\Resources\CrewResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Kumi\Norikumi\Support\Enums\IdentityGroup;
use Kumi\Norikumi\Support\Enums\IdentityStatus;
use Kumi\Norikumi\Support\Enums\IdentityType;

class PersonalIdentitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'identities';

    protected static ?string $recordTitleAttribute = 'type';

    protected static ?string $title = 'Personal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label(__('norikumi::filament/resources/identity.fields.type.label'))
                    ->options([
                        IdentityType::PASSPORT => __('norikumi::filament/resources/identity.fields.type.options.' . IdentityType::PASSPORT),
                        IdentityType::FAMILY_CARD => __('norikumi::filament/resources/identity.fields.type.options.' . IdentityType::FAMILY_CARD),
                        IdentityType::IDENTITY_CARD => __('norikumi::filament/resources/identity.fields.type.options.' . IdentityType::IDENTITY_CARD),
                        IdentityType::DRIVING_LICENSE => __('norikumi::filament/resources/identity.fields.type.options.' . IdentityType::DRIVING_LICENSE),
                    ])
                    ->default(IdentityType::IDENTITY_CARD)
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->label(__('norikumi::filament/resources/identity.fields.number.label'))
                    ->required(),
                Forms\Components\Textarea::make('remarks')
                    ->label(__('norikumi::filament/resources/identity.fields.remarks.label'))
                    ->nullable(),
                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\DatePicker::make('expired_at')
                        ->label(__('norikumi::filament/resources/identity.fields.expired_at.label'))
                        ->reactive()
                        ->displayFormat('d F Y')
                        ->closeOnDateSelection()
                        ->required(function (\Closure $get) {
                            // @codeCoverageIgnoreStart
                            return $get('is_permanent') === false;
                            // @codeCoverageIgnoreEnd
                        })
                        ->nullable(function (\Closure $get) {
                            // @codeCoverageIgnoreStart
                            return $get('is_permanent') === true;
                            // @codeCoverageIgnoreEnd
                        })
                        ->afterStateUpdated(function (\Closure $set, ?string $state) {
                            // @codeCoverageIgnoreStart
                            $set('is_permanent', is_null($state) ? true : false);
                            // @codeCoverageIgnoreEnd
                        }),
                    Forms\Components\Checkbox::make('is_permanent')
                        ->label(__('norikumi::filament/resources/identity.fields.is_permanent.label'))
                        ->reactive()
                        ->dehydrated(false)
                        ->afterStateHydrated(function (\Closure $set, \Closure $get) {
                            // @codeCoverageIgnoreStart
                            if ($get('expired_at') === null) {
                                $set('is_permanent', true);
                            }
                            // @codeCoverageIgnoreEnd
                        })
                        ->afterStateUpdated(function (\Closure $set, bool $state) {
                            // @codeCoverageIgnoreStart
                            if ($state) {
                                $set('expired_at', null);
                            }
                            // @codeCoverageIgnoreEnd
                        }),
                ])->columnSpan(1),
                Forms\Components\SpatieMediaLibraryFileUpload::make('front_side')
                    ->collection('front-side')
                    ->label(__('norikumi::filament/resources/identity.fields.front_side.label'))
                    ->imagePreviewHeight('256')
                    ->conversion('preview')
                    ->enableDownload()
                    ->preserveFilenames()
                    ->required(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('back_side')
                    ->collection('back-side')
                    ->label(__('norikumi::filament/resources/identity.fields.back_side.label'))
                    ->imagePreviewHeight('256')
                    ->conversion('preview')
                    ->multiple()
                    ->enableDownload()
                    ->preserveFilenames(),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label(__('norikumi::filament/resources/identity.columns.type.label'))
                    ->formatStateUsing(function (string $state) {
                        return __("norikumi::filament/resources/identity.columns.type.options.{$state}");
                    }),
                Tables\Columns\TextColumn::make('number')
                    ->label(__('norikumi::filament/resources/identity.columns.number.label'))
                    ->toggleable()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('expired_at')
                    ->label(__('norikumi::filament/resources/identity.columns.expired_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    })
                    ->toggleable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('norikumi::filament/resources/identity.columns.status.label'))
                    ->enum([
                        IdentityStatus::PERMANENT => __('norikumi::filament/resources/identity.columns.status.options.' . IdentityStatus::PERMANENT),
                        IdentityStatus::ACTIVE => __('norikumi::filament/resources/identity.columns.status.options.' . IdentityStatus::ACTIVE),
                        IdentityStatus::EXPIRED => __('norikumi::filament/resources/identity.columns.status.options.' . IdentityStatus::EXPIRED),
                    ])
                    ->colors([
                        'primary' => fn (string $state) => $state === IdentityStatus::PERMANENT,
                        'success' => fn (string $state) => $state === IdentityStatus::ACTIVE,
                        'danger' => fn (string $state) => $state === IdentityStatus::EXPIRED,
                    ])
                    ->toggleable()
                    ->extraAttributes(['class' => 'font-mono']),
            ])
            ->filters([
                Filter::make('status')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label(__('norikumi::filament/resources/identity.filters.status.label'))
                            ->options([
                                IdentityStatus::PERMANENT => __('norikumi::filament/resources/identity.filters.status.options.' . IdentityStatus::PERMANENT),
                                IdentityStatus::ACTIVE => __('norikumi::filament/resources/identity.filters.status.options.' . IdentityStatus::ACTIVE),
                                IdentityStatus::EXPIRED => __('norikumi::filament/resources/identity.filters.status.options.' . IdentityStatus::EXPIRED),
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['status'] === IdentityStatus::PERMANENT,
                                fn (Builder $query): Builder => $query->whereNull('expired_at'),
                            )
                            ->when(
                                $data['status'] === IdentityStatus::ACTIVE,
                                fn (Builder $query): Builder => $query->whereDate('expired_at', '>', Carbon::now()),
                            )
                            ->when(
                                $data['status'] === IdentityStatus::EXPIRED,
                                fn (Builder $query): Builder => $query->whereDate('expired_at', '<=', Carbon::now()),
                            )
                        ;
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['group'] = IdentityGroup::PERSONAL;

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    protected function getTableHeading(): string|Htmlable|\Closure|null
    {
        return static::$title;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        $query = $this->getRelationship()->getQuery();

        return $query->personal()->latest('type');
    }
}
