<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Sousa\Support\Enums\VesselDocumentStatus;
use Illuminate\Database\Eloquent\Relations\Relation;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Kumi\Sousa\Filament\Resources\VesselResource\RelationManagers\Table\Actions;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('name')
                                ->label(__('sousa::filament/resources/vessel-document.fields.name.label'))
                                ->required(),
                            Forms\Components\TextInput::make('document_number')
                                ->label(__('sousa::filament/resources/vessel-document.fields.document_number.label'))
                                ->nullable(),
                            Forms\Components\Textarea::make('description')
                                ->label(__('sousa::filament/resources/vessel-document.fields.description.label'))
                                ->nullable()
                                ->columnSpan(2),
                            Forms\Components\Textarea::make('remarks')
                                ->label(__('sousa::filament/resources/vessel-document.fields.remarks.label'))
                                ->nullable()
                                ->columnSpan(2),
                        ])->columns(2)->columnSpan(2),
                        Forms\Components\Group::make([
                            Forms\Components\DatePicker::make('issued_at')
                                ->label(__('sousa::filament/resources/vessel-document.fields.issued_at.label'))
                                ->displayFormat('d F Y')
                                // ->minDate(Carbon::now())
                                ->maxDate(Carbon::parse('31 Dec 2200'))
                                ->default(Carbon::now()->addDay())
                                ->required(),
                            // Forms\Components\DatePicker::make('endorsed_at')
                            //     ->label(__('sousa::filament/resources/vessel-document.fields.endorsed_at.label'))
                            //     ->displayFormat('d F Y')
                            //     // ->minDate(Carbon::now())
                            //     ->maxDate(Carbon::parse('31 Dec 2200'))
                            //     ->nullable(),
                            Forms\Components\DatePicker::make('endorse_period_started_at')
                                ->label(__('sousa::filament/resources/vessel-document.fields.endorse_period_started_at.label'))
                                ->displayFormat('d F Y')
                                // ->minDate(Carbon::now())
                                ->maxDate(Carbon::parse('31 Dec 2200'))
                                ->nullable(),
                            Forms\Components\DatePicker::make('endorse_period_finished_at')
                                ->label(__('sousa::filament/resources/vessel-document.fields.endorse_period_finished_at.label'))
                                ->displayFormat('d F Y')
                                // ->minDate(Carbon::now())
                                ->maxDate(Carbon::parse('31 Dec 2200'))
                                ->nullable(),
                            Forms\Components\DatePicker::make('expired_at')
                                ->label(__('sousa::filament/resources/vessel-document.fields.expired_at.label'))
                                ->displayFormat('d F Y')
                                ->minDate(Carbon::now())
                                ->maxDate(Carbon::parse('31 Dec 2222'))
                                ->default(Carbon::now()->addDay())
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(function (\Closure $set, $state) {
                                    $isPermanentYear = Carbon::parse($state)->year === 2222;

                                    $set('is_permanent', $isPermanentYear ? true : false);
                                }),
                            Forms\Components\Toggle::make('is_permanent')
                                ->label(__('sousa::filament/resources/vessel-document.fields.is_permanent.label'))
                                ->reactive()
                                ->afterStateUpdated(function (\Closure $set, $state) {
                                    $now = Carbon::now();
                                    $permanent = Carbon::parse('12 Dec 2222');

                                    $set('expired_at', $state ? $permanent : $now);
                                }),
                        ])->columns(1)->columnSpan(1),
                    ]),
                Forms\Components\Section::make('')
                    ->heading('Attachments')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('attachments')
                            ->disableLabel()
                            ->collection('attachments')
                            ->preserveFilenames()
                            ->multiple()
                            ->enableReordering()
                            ->enableDownload(),
                    ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sortable_order')
                    ->label(__('sousa::filament/resources/vessel-document.columns.sortable_order.label')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('sousa::filament/resources/vessel-document.columns.name.label'))
                    ->description(function (Model $record) {
                        return ! is_null($record->document_number)
                            ? $record->document_number
                            : new HtmlString('-');
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('document_number')
                    ->label(__('sousa::filament/resources/vessel-document.columns.document_number.label'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('issued_at')
                    ->label(__('sousa::filament/resources/vessel-document.columns.issued_at.label'))
                    ->formatStateUsing(function (?Carbon $state) {
                        return $state ? $state->format('d M Y') : null;
                    }),
                // Tables\Columns\TextColumn::make('endorsed_at')
                //     ->label(__('sousa::filament/resources/vessel-document.columns.endorsed_at.label'))
                //     ->formatStateUsing(function (?Carbon $state) {
                //         return $state ? $state->format('d M Y') : null;
                //     }),
                Tables\Columns\TextColumn::make('endorse_period_started_at')
                    ->label(__('sousa::filament/resources/vessel-document.columns.endorse_period_started_at.label'))
                    ->formatStateUsing(function (?Carbon $state) {
                        return $state ? $state->format('d M Y') : null;
                    }),
                Tables\Columns\TextColumn::make('endorse_period_finished_at')
                    ->label(__('sousa::filament/resources/vessel-document.columns.endorse_period_finished_at.label'))
                    ->formatStateUsing(function (?Carbon $state) {
                        return $state ? $state->format('d M Y') : null;
                    }),
                Tables\Columns\TextColumn::make('expired_at')
                    ->label(__('sousa::filament/resources/vessel-document.columns.expired_at.label'))
                    ->formatStateUsing(function (?Carbon $state) {
                        return $state ? $state->format('d M Y') : null;
                    }),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('sousa::filament/resources/vessel-document.columns.status.label'))
                    ->formatStateUsing(function (Model $record) {
                        return match (true) {
                            $record->isExpired() => 'Expired',
                            $record->isExpiringSoon() => 'Expiring Soon',
                            $record->isActive() => 'Active',
                        };
                    })
                    ->colors(function (Model $record): array {
                        return [
                            'success' => static fn (): bool => $record->isActive(),
                            'warning' => static fn (): bool => $record->isExpiringSoon(),
                            'danger' => static fn (): bool => $record->isExpired(),
                        ];
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        VesselDocumentStatus::ACTIVE => __('sousa::filament/resources/vessel-document.filters.status.options.' . VesselDocumentStatus::ACTIVE),
                        VesselDocumentStatus::EXPIRING_SOON => __('sousa::filament/resources/vessel-document.filters.status.options.' . VesselDocumentStatus::EXPIRING_SOON),
                        VesselDocumentStatus::EXPIRED => __('sousa::filament/resources/vessel-document.filters.status.options.' . VesselDocumentStatus::EXPIRED),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        $now = Carbon::now();
                        $twentyOneDaysLater = $now->copy()->addDays(21);
                        $twentyFourHoursLater = $now->copy()->addHours(24);

                        return match (true) {
                            $data['value'] === VesselDocumentStatus::ACTIVE => $query->where('expired_at', '>=', $twentyOneDaysLater),
                            $data['value'] === VesselDocumentStatus::EXPIRING_SOON => $query->where([
                                ['expired_at', '<', $twentyOneDaysLater],
                                ['expired_at', '>', $now],
                            ]),
                            $data['value'] === VesselDocumentStatus::EXPIRED => $query
                                ->where('expired_at', '<', $now)
                                ->orWhere('expired_at', '<', $twentyFourHoursLater),
                            default => $query,
                        };
                    }),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public function toggleTableReordering(): void
    {
        parent::toggleTableReordering();

        $this->tableSearchQuery = '';

        $this->getTableFiltersForm()->fill();
    }

    public function isTableFilterable(): bool
    {
        return ! $this->isTableReordering() && parent::isTableFilterable();
    }

    public function isTableSearchable(): bool
    {
        return ! $this->isTableReordering() && parent::isTableSearchable();
    }

    protected function getTableQuery(): Builder|Relation
    {
        return parent::getTableQuery()->ordered();
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableReorderColumn(): ?string
    {
        return 'sortable_order';
    }
}
