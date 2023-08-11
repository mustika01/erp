<?php

namespace Kumi\Norikumi\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Norikumi\Filament\Resources\PayoutResource\Pages;
use Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers;
use Kumi\Norikumi\Filament\Resources\PayoutResource\Tables\Actions as TableActions;
use Kumi\Norikumi\Models\Contract;
use Kumi\Norikumi\Models\Payout;
use Kumi\Norikumi\Models\PayoutItem;
use Kumi\Sousa\Models\Vessel;

class PayoutResource extends Resource
{
    protected static ?string $model = Payout::class;

    protected static ?string $navigationGroup = 'norikumi';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2104;

    protected static ?string $slug = 'norikumi/payouts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('norikumi::filament/resources/ticket-salary-advance.headings.crew_information.label'))
                    ->schema([
                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\Placeholder::make('name')
                                    ->label(__('norikumi::filament/resources/ticket-salary-advance.placeholders.name.label'))
                                    ->content(function (?Model $record) {
                                        return $record->payroll->crew->name;
                                    }),
                                Forms\Components\Placeholder::make('nic_no')
                                    ->label(__('norikumi::filament/resources/ticket-salary-advance.placeholders.nic_no.label'))
                                    ->content(function (?Model $record) {
                                        return $record->payroll->crew->identity_card_number;
                                    }),
                            ]),
                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\Placeholder::make('position')
                                    ->label(__('norikumi::filament/resources/ticket-salary-advance.placeholders.position.label'))
                                    ->content(function (?Model $record) {
                                        return __('norikumi::filament/resources/ticket-salary-advance.placeholders.position.options.' . $record->payroll->crew->position);
                                    }),
                                Forms\Components\Placeholder::make('position_grade')
                                    ->label(__('norikumi::filament/resources/ticket-salary-advance.placeholders.position_grade.label'))
                                    ->content(function (?Model $record) {
                                        return $record->payroll->crew->position_grade;
                                    }),
                                Forms\Components\Placeholder::make('started_at')
                                    ->label(__('norikumi::filament/resources/ticket-salary-advance.placeholders.started_at.label'))
                                    ->content(function (?Model $record) {
                                        $contract = $record->payroll->crew->latestActiveContract;

                                        return is_null($contract) ? 'N/A' : $contract->started_at->format('d F Y');
                                    }),
                                Forms\Components\Placeholder::make('contract_duration')
                                    ->label(__('norikumi::filament/resources/ticket-salary-advance.placeholders.contract_duration.label'))
                                    ->content(function (?Model $record) {
                                        $contracts = $record->payroll->crew->contracts;

                                        $months = $contracts->map(function (Contract $contract) {
                                            return $contract->started_at->diffInMonths($contract->ended_at);
                                        })->sum();

                                        $years = floor($months / 12);

                                        $months = $months % 12;

                                        $result = '';

                                        if ($years > 0) {
                                            $result = $result . "{$years} Years ";
                                        }

                                        if ($months > 0) {
                                            $result = $result . "{$months} Months";
                                        }

                                        return $result;
                                    }),
                            ]),
                    ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ViewColumn::make('name_position')
                    ->label(__('norikumi::filament/resources/payout.columns.name_position.label'))
                    ->view('norikumi::filament.resources.payout.tables.columns.name-position'),
                Tables\Columns\TextColumn::make('finalized_at')
                    ->label(__('norikumi::filament/resources/payout.columns.finalized_at.label'))
                    ->formatStateUsing(function (Carbon $state) {
                        return $state->format('d F Y');
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('base_amount_formatted')
                    ->label(__('norikumi::filament/resources/payout.columns.base_amount.label'))
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->sortAmount(PayoutItem::TYPE_BASIC, $direction);
                    })
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('loan_amount_formatted')
                    ->label(__('norikumi::filament/resources/payout.columns.loan_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('adjustment_amount_formatted')
                    ->label(__('norikumi::filament/resources/payout.columns.adjustment_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('take_home_pay_amount_formatted')
                    ->label(__('norikumi::filament/resources/payout.columns.take_home_pay_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('primary_bank_name')
                    ->label(__('norikumi::filament/resources/payout.columns.primary_bank_name.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('primary_bank_account_number')
                    ->label(__('norikumi::filament/resources/payout.columns.primary_bank_account_number.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payroll.salary_grade')
                    ->label(__('norikumi::filament/resources/payout.columns.salary_grade.label'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('approvals_count')
                    ->label(__('norikumi::filament/resources/payout.columns.approvals.label'))
                    ->counts('approvals')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('vessel')
                    ->label(__('norikumi::filament/resources/payout.filters.vessel.label'))
                    ->options(self::getDepartmentOptions())
                    ->query(function (Builder $query, array $data): Builder {
                        $vessel = $data['value'];

                        return $vessel
                            ? $query->byVessel($vessel)
                            : $query;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                TableActions\ApproveBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PayoutItemsRelationManager::class,
            RelationManagers\ApprovalsRelationManager::class,
            RelationManagers\DisbursementsRelationManager::class,
            RelationManagers\ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayouts::route('/'),

            'view' => Pages\ViewPayout::route('/{record}'),
        ];
    }

    protected static function getDepartmentOptions(): array
    {
        return Vessel::all()
            ->mapWithKeys(function (Vessel $vessel) {
                return [$vessel->id => $vessel->name];
            })->toArray();
    }
}
