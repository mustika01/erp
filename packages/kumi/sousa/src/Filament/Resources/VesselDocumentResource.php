<?php

namespace Kumi\Sousa\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;
use Kumi\Sousa\Filament\Resources\VesselDocumentResource\Pages;
use Kumi\Sousa\Models\VesselDocument;
use Kumi\Sousa\Support\Enums\VesselDocumentStatus;

class VesselDocumentResource extends Resource
{
    protected static ?string $model = VesselDocument::class;

    protected static ?string $modelLabel = 'Document';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?int $navigationSort = 3003;

    protected static ?string $slug = 'sousa/vessel-documents';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('remarks')
                    ->label(__('sousa::filament/resources/vessel-document.fields.remarks.label'))
                    ->nullable()
                    ->columnSpan(2),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vessel.name')
                    ->label(__('sousa::filament/resources/vessel-document.columns.vessel.label'))
                    ->searchable(),
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
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('endorse_period_started_at')
                    ->label(__('sousa::filament/resources/vessel-document.columns.endorse_period_started_at.label'))
                    ->formatStateUsing(function (?Carbon $state) {
                        return $state ? $state->format('d M Y') : null;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('endorse_period_finished_at')
                    ->label(__('sousa::filament/resources/vessel-document.columns.endorse_period_finished_at.label'))
                    ->formatStateUsing(function (?Carbon $state) {
                        return $state ? $state->format('d M Y') : null;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('remarks')
                    ->label(__('sousa::filament/resources/vessel-document.columns.remarks.label')),
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ])
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
            'index' => Pages\ListVesselDocuments::route('/'),
            // 'create' => Pages\CreateVesselDocument::route('/create'),
            // 'edit' => Pages\EditVesselDocument::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->oldest('expired_at');
    }
}
