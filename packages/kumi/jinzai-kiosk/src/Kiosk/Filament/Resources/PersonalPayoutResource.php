<?php

namespace Kumi\Kiosk\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\PersonalPayout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Kiosk\Support\Enums\PayoutStatus;
use Kumi\Kiosk\Actions\RetrievePayoutApprovalStatus;
use Kumi\Kiosk\Filament\Resources\PersonalPayoutResource\Pages;
use Kumi\Kiosk\Filament\Resources\PersonalPayoutResource\RelationManagers;

class PersonalPayoutResource extends Resource
{
    protected static ?string $modelLabel = 'Payout';

    protected static ?string $model = PersonalPayout::class;

    protected static ?string $navigationGroup = 'kiosk';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1002;

    protected static ?string $slug = 'kiosk/payouts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\Section::make('description')
                            ->heading(__('kiosk::filament/resources/payout.fields.description.label'))
                            ->schema([
                                Forms\Components\Placeholder::make('description')
                                    ->disableLabel()
                                    ->content(function (Model $record) {
                                        return $record->description;
                                    }),
                            ])
                            ->columnSpan(1),
                        Forms\Components\Section::make('started_at')
                            ->heading(__('kiosk::filament/resources/payout.fields.started_at.label'))
                            ->schema([
                                Forms\Components\Placeholder::make('started_at')
                                    ->disableLabel()
                                    ->content(function (Model $record) {
                                        return $record->started_at->format('d F Y');
                                    }),
                            ])
                            ->columnSpan(1),
                        Forms\Components\Section::make('finalized_at')
                            ->heading(__('kiosk::filament/resources/payout.fields.finalized_at.label'))
                            ->schema([
                                Forms\Components\Placeholder::make('finalized_at')
                                    ->disableLabel()
                                    ->content(function (Model $record) {
                                        return $record->finalized_at->format('d F Y');
                                    }),
                            ])
                            ->columnSpan(1),
                        Forms\Components\Section::make('status')
                            ->heading(__('kiosk::filament/resources/payout.fields.status.label'))
                            ->schema([
                                Forms\Components\Placeholder::make('status')
                                    ->disableLabel()
                                    ->content(function (Model $record) {
                                        return RetrievePayoutApprovalStatus::run($record);
                                    }),
                            ])
                            ->columnSpan(1),
                    ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('finalized_at')
                    ->label(__('kiosk::filament/resources/payout.columns.finalized_at.label'))
                    ->formatStateUsing(function (Carbon $state) {
                        return $state->format('F Y');
                    }),
                Tables\Columns\TextColumn::make('take_home_pay_amount_formatted')
                    ->label(__('kiosk::filament/resources/payout.columns.take_home_pay_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('primary_bank_name')
                    ->label(__('kiosk::filament/resources/payout.columns.primary_bank_name.label')),
                Tables\Columns\TextColumn::make('primary_bank_account_number')
                    ->label(__('kiosk::filament/resources/payout.columns.primary_bank_account_number.label')),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('kiosk::filament/resources/payout.columns.status.label'))
                    ->enum([
                        PayoutStatus::PENDING => __('kiosk::filament/resources/payout.columns.status.options.' . PayoutStatus::PENDING),
                        PayoutStatus::APPROVED => __('kiosk::filament/resources/payout.columns.status.options.' . PayoutStatus::APPROVED),
                    ])
                    ->colors([
                        null,
                        'primary' => fn (string $state) => $state === PayoutStatus::APPROVED,
                    ])
                    ->getStateUsing(function (Model $record) {
                        return RetrievePayoutApprovalStatus::run($record);
                    })
                    ->extraAttributes(['class' => 'font-mono']),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([

            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PersonalPayoutItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayouts::route('/'),
            // 'create' => Pages\CreatePayroll::route('/create'),
            'view' => Pages\ViewPayout::route('/{record}'),
            // 'edit' => Pages\EditPayroll::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('payroll_id', Auth::user()->employee->payroll->id ?? 0);
    }
}
