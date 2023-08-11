<?php

namespace Kumi\Norikumi\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Kumi\Norikumi\Filament\Resources\RegistrationFormEntryResource\Pages;
use Kumi\Norikumi\Filament\Resources\RegistrationFormEntryResource\Tables\Actions as TableActions;
use Kumi\Norikumi\Models\RegistrationFormEntry;
use Kumi\Norikumi\Support\Enums\DepartmentType;

class RegistrationFormEntryResource extends Resource
{
    protected static ?string $modelLabel = 'Registration Form Entry';

    protected static ?string $model = RegistrationFormEntry::class;

    protected static ?string $navigationGroup = 'norikumi';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2105;

    protected static ?string $slug = 'norikumi/registration-form-entries';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label(__('norikumi::filament/resources/registration-form-entry.fields.name.label')),
            Forms\Components\Select::make('department')
                ->label(__('norikumi::filament/resources/registration-form-entry.fields.department.label'))
                ->options([
                    DepartmentType::DECK => __('norikumi::filament/resources/registration-form-entry.fields.department.options.' . DepartmentType::DECK),
                    DepartmentType::ENGINE => __('norikumi::filament/resources/registration-form-entry.fields.department.options.' . DepartmentType::ENGINE),
                ]),
            Forms\Components\KeyValue::make('properties')
                ->visible(function (string $context) {
                    return $context === 'view';
                })
                ->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('norikumi::filament/resources/registration-form-entry.columns.id.label')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('norikumi::filament/resources/registration-form-entry.columns.name.label')),
                Tables\Columns\TextColumn::make('department')
                    ->label(__('norikumi::filament/resources/registration-form-entry.columns.department.label'))
                    ->formatStateUsing(function (string $state) {
                        return __('norikumi::filament/resources/registration-form-entry.columns.department.options.' . $state);
                    }),
                Tables\Columns\TextColumn::make('pin_code')
                    ->label(__('norikumi::filament/resources/registration-form-entry.columns.pin_code.label'))
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('completed_date')
                    ->label(__('norikumi::filament/resources/registration-form-entry.columns.completed_date.label')),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->visible(function (Model $record) {
                        return $record->isCompleted();
                    }),
                // Tables\Actions\EditAction::make(),
                TableActions\ArchiveAction::make(),
                TableActions\DownloadAction::make(),
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
            'index' => Pages\ManageRegistrationFormEntries::route('/'),
        ];
    }
}
