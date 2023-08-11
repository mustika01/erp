<?php

namespace Kumi\Jinzai\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Carbon;
use Kumi\Jinzai\Models\Payout;
use Filament\Resources\Resource;
use Kumi\Jinzai\Models\PayoutItem;
use Kumi\Kiosk\Actions\CalculateAge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Jinzai\Filament\Resources\PayoutResource\Pages;
use Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers;
use Kumi\Jinzai\Filament\Resources\PayoutResource\Filters\PeriodFilter;
use Kumi\Jinzai\Filament\Resources\PayoutResource\Tables\Actions as TableActions;

class PayoutResource extends Resource
{
    protected static ?string $model = Payout::class;

    protected static ?string $navigationGroup = 'jinzai';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2004;

    protected static ?string $slug = 'jinzai/payouts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('kanri::filament/resources/ticket-salary-advance.headings.employee_information.label'))
                    ->schema([
                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\Placeholder::make('name')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.name.label'))
                                    ->content(function (?Model $record) {
                                        return $record->payroll->employee->user->name;
                                    }),
                                Forms\Components\Placeholder::make('internal_id')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.internal_id.label'))
                                    ->content(function (?Model $record) {
                                        return $record->payroll->employee->internal_id;
                                    }),
                                Forms\Components\Placeholder::make('nic_no')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.nic_no.label'))
                                    ->content(function (?Model $record) {
                                        return $record->payroll->employee->identity_card_number;
                                    }),
                            ]),
                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\Placeholder::make('department')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.department.label'))
                                    ->content(function (?Model $record) {
                                        return $record->payroll->employee->department;
                                    }),
                                Forms\Components\Placeholder::make('job_position')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.job_position.label'))
                                    ->content(function (?Model $record) {
                                        return $record->payroll->employee->job_position;
                                    }),
                                Forms\Components\Placeholder::make('joined_at')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.joined_at.label'))
                                    ->content(function (?Model $record) {
                                        $employment = $record->payroll->employee->latestActiveEmployment;

                                        return is_null($employment) ? 'N/A' : $employment->joined_at->format('d F Y');
                                    }),
                                Forms\Components\Placeholder::make('length_of_employment')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.length_of_employment.label'))
                                    ->content(function (?Model $record) {
                                        $employment = $record->payroll->employee->latestActiveEmployment;

                                        return is_null($employment) ? 'N/A' : CalculateAge::run($employment->joined_at);
                                    }),
                            ]),
                    ])
                    ->columns(4),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ViewColumn::make('name_position')
                    ->label(__('jinzai::filament/resources/payout.columns.name_position.label'))
                    ->view('jinzai::filament.resources.payout.tables.columns.name-position'),
                Tables\Columns\TextColumn::make('finalized_at')
                    ->label(__('jinzai::filament/resources/payout.columns.finalized_at.label'))
                    ->formatStateUsing(function (Carbon $state) {
                        return $state->format('d F Y');
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('base_amount_formatted')
                    ->label(__('jinzai::filament/resources/payout.columns.base_amount.label'))
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->sortAmount(PayoutItem::TYPE_BASIC, $direction);
                    })
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('job_allowance_amount_formatted')
                    ->label(__('jinzai::filament/resources/payout.columns.job_allowance_amount.label'))
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->sortAmount(PayoutItem::TYPE_JOB_ALLOWANCE, $direction);
                    })
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('loan_amount_formatted')
                    ->label(__('jinzai::filament/resources/payout.columns.loan_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('adjustment_amount_formatted')
                    ->label(__('jinzai::filament/resources/payout.columns.adjustment_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('take_home_pay_amount_formatted')
                    ->label(__('jinzai::filament/resources/payout.columns.take_home_pay_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('primary_bank_name')
                    ->label(__('jinzai::filament/resources/payout.columns.primary_bank_name.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('primary_bank_account_number')
                    ->label(__('jinzai::filament/resources/payout.columns.primary_bank_account_number.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payroll.salary_grade')
                    ->label(__('jinzai::filament/resources/payout.columns.salary_grade.label'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('approvals_count')
                    ->label(__('jinzai::filament/resources/payout.columns.approvals.label'))
                    ->counts('approvals')
                    ->toggleable(),
            ])
            ->filters([
                PeriodFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                TableActions\ApproveBulkAction::make(),
                TableActions\DisburseBulkAction::make(),
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
            // 'create' => Pages\CreatePayroll::route('/create'),
            'view' => Pages\ViewPayout::route('/{record}'),
            // 'edit' => Pages\EditPayroll::route('/{record}/edit'),
        ];
    }
}
