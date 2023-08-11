<?php

namespace Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Livewire\Component as Livewire;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Jinzai\Support\Enums\BankProvider;
use Kumi\Jinzai\Validation\Rules\ValidBankAccount;
use Filament\Resources\RelationManagers\RelationManager;
use Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector\Actions\RetrieveBankAccountName;
use Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers\BanksRelationManager\Actions as RelationManagerActions;

class BanksRelationManager extends RelationManager
{
    protected static string $relationship = 'banks';

    protected static ?string $recordTitleAttribute = 'bank_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bank_name')
                    ->label(__('jinzai::filament/resources/bank.fields.bank_name.label'))
                    ->options([
                        BankProvider::BCA => __('jinzai::filament/resources/bank.fields.bank_name.options.' . BankProvider::BCA),
                        BankProvider::MANDIRI => __('jinzai::filament/resources/bank.fields.bank_name.options.' . BankProvider::MANDIRI),
                        BankProvider::BNI => __('jinzai::filament/resources/bank.fields.bank_name.options.' . BankProvider::BNI),
                        BankProvider::BRI => __('jinzai::filament/resources/bank.fields.bank_name.options.' . BankProvider::BRI),
                        BankProvider::BTN => __('jinzai::filament/resources/bank.fields.bank_name.options.' . BankProvider::BTN),
                        BankProvider::BSI => __('jinzai::filament/resources/bank.fields.bank_name.options.' . BankProvider::BSI),
                    ])
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(\Closure::fromCallable([self::class, 'retrieveBankAccountName'])),
                Forms\Components\TextInput::make('account_number')
                    ->label(__('jinzai::filament/resources/bank.fields.account_number.label'))
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(\Closure::fromCallable([self::class, 'retrieveBankAccountName'])),
                Forms\Components\TextInput::make('account_holder_name')
                    ->label(__('jinzai::filament/resources/bank.fields.account_holder_name.label'))
                    ->disabled()
                    ->required()
                    ->rules([new ValidBankAccount()]),
                Forms\Components\Toggle::make('is_primary')
                    ->default(function (Livewire $livewire) {
                        return ! $livewire->getOwnerRecord()->hasAnyBanks();
                    })
                    ->label(__('jinzai::filament/resources/bank.fields.is_primary.label')),
            ])
            ->columns(1)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bank_name')
                    ->label(__('jinzai::filament/resources/bank.columns.bank_name.label')),
                Tables\Columns\TextColumn::make('account_number')
                    ->label(__('jinzai::filament/resources/bank.columns.account_number.label')),
                Tables\Columns\TextColumn::make('account_holder_name')
                    ->label(__('jinzai::filament/resources/bank.columns.account_holder_name.label')),
                Tables\Columns\BooleanColumn::make('is_primary')
                    ->label(__('jinzai::filament/resources/bank.columns.is_primary.label')),
            ])
            ->filters([

            ])
            ->headerActions([
                RelationManagerActions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                RelationManagerActions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        $query = $this->getRelationship()->getQuery();

        return $query->latest();
    }

    protected static function retrieveBankAccountName(\Closure $get, \Closure $set): void
    {
        $bankName = $get('bank_name');
        $accountNumber = $get('account_number');

        if (! empty($bankName) && ! empty($accountNumber)) {
            $accountName = RetrieveBankAccountName::run($accountNumber, $bankName);

            $set('account_holder_name', $accountName);
        }
    }
}
