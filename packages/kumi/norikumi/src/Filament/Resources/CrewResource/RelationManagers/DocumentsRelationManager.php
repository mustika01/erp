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
use Kumi\Norikumi\Support\Enums\DocumentStatus;
use Kumi\Norikumi\Support\Enums\DocumentType;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    protected static ?string $recordTitleAttribute = 'type';

    protected static ?string $title = 'Documents';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label(__('norikumi::filament/resources/document.fields.type.label'))
                    ->options([
                        DocumentType::AGREEMENT => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::AGREEMENT),
                        DocumentType::BST => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::BST),
                        DocumentType::CERTIFICATION => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::CERTIFICATION),
                        DocumentType::CREW_FORM => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::CREW_FORM),
                        DocumentType::DIPLOMA_DEGREE_RATINGS => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::DIPLOMA_DEGREE_RATINGS),
                        DocumentType::DELEGATION => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::DELEGATION),
                        DocumentType::GM_DSS => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::GM_DSS),
                        DocumentType::MEDICAL_CHECKUP => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::MEDICAL_CHECKUP),
                        DocumentType::ORU => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::ORU),
                        DocumentType::PKL => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::PKL),
                        DocumentType::SEAMAN_SERVICE_BOOK => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::SEAMAN_SERVICE_BOOK),
                        DocumentType::SIGN_ON => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::SIGN_ON),
                        DocumentType::SIGN_OFF => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::SIGN_OFF),
                        DocumentType::SHIP_MUTATION => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::SHIP_MUTATION),
                        DocumentType::VAKSIN => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::VAKSIN),
                        DocumentType::YELLOW_FEVER => __('norikumi::filament/resources/document.fields.type.options.' . DocumentType::YELLOW_FEVER),
                    ])
                    ->default(DocumentType::DELEGATION)
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->label(__('norikumi::filament/resources/document.fields.number.label'))
                    ->required(),
                Forms\Components\Textarea::make('remarks')
                    ->label(__('norikumi::filament/resources/document.fields.remarks.label'))
                    ->nullable(),
                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\DatePicker::make('expired_at')
                        ->label(__('norikumi::filament/resources/document.fields.expired_at.label'))
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
                        ->label(__('norikumi::filament/resources/document.fields.is_permanent.label'))
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
                Forms\Components\SpatieMediaLibraryFileUpload::make('document')
                    ->label(__('norikumi::filament/resources/document.fields.document.label'))
                    ->collection('document')
                    ->imagePreviewHeight('256')
                    ->conversion('preview')
                    ->multiple()
                    ->enableDownload()
                    ->preserveFilenames()
                    ->columnSpanFull(),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label(__('norikumi::filament/resources/document.columns.type.label'))
                    ->formatStateUsing(function (string $state) {
                        return __("norikumi::filament/resources/document.columns.type.options.{$state}");
                    }),
                Tables\Columns\TextColumn::make('number')
                    ->label(__('norikumi::filament/resources/document.columns.number.label'))
                    ->toggleable()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('expired_at')
                    ->label(__('norikumi::filament/resources/document.columns.expired_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : '';
                    })
                    ->toggleable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('norikumi::filament/resources/document.columns.status.label'))
                    ->enum([
                        DocumentStatus::PERMANENT => __('norikumi::filament/resources/document.columns.status.options.' . DocumentStatus::PERMANENT),
                        DocumentStatus::ACTIVE => __('norikumi::filament/resources/document.columns.status.options.' . DocumentStatus::ACTIVE),
                        DocumentStatus::EXPIRED => __('norikumi::filament/resources/document.columns.status.options.' . DocumentStatus::EXPIRED),
                    ])
                    ->colors([
                        'primary' => fn (string $state) => $state === DocumentStatus::PERMANENT,
                        'success' => fn (string $state) => $state === DocumentStatus::ACTIVE,
                        'danger' => fn (string $state) => $state === DocumentStatus::EXPIRED,
                    ])
                    ->toggleable()
                    ->extraAttributes(['class' => 'font-mono']),
            ])
            ->filters([
                Filter::make('status')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label(__('norikumi::filament/resources/document.filters.status.label'))
                            ->options([
                                DocumentStatus::PERMANENT => __('norikumi::filament/resources/document.filters.status.options.' . DocumentStatus::PERMANENT),
                                DocumentStatus::ACTIVE => __('norikumi::filament/resources/document.filters.status.options.' . DocumentStatus::ACTIVE),
                                DocumentStatus::EXPIRED => __('norikumi::filament/resources/document.filters.status.options.' . DocumentStatus::EXPIRED),
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['status'] === DocumentStatus::PERMANENT,
                                fn (Builder $query): Builder => $query->whereNull('expired_at'),
                            )
                            ->when(
                                $data['status'] === DocumentStatus::ACTIVE,
                                fn (Builder $query): Builder => $query->whereDate('expired_at', '>', Carbon::now()),
                            )
                            ->when(
                                $data['status'] === DocumentStatus::EXPIRED,
                                fn (Builder $query): Builder => $query->whereDate('expired_at', '<=', Carbon::now()),
                            )
                        ;
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
