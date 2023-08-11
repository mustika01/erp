<?php

namespace Kumi\Jinzai\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Filament\Resources\DepartmentResource\Pages;
use Kumi\Jinzai\Filament\Resources\DepartmentResource\RelationManagers;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationGroup = 'jinzai';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2005;

    protected static ?string $slug = 'jinzai/departments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('jinzai::filament/resources/department.fields.name.label'))
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label(__('jinzai::filament/resources/department.fields.description.label')),
                    ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('jinzai::filament/resources/department.columns.name.label')),
                Tables\Columns\TextColumn::make('code')
                    ->label(__('jinzai::filament/resources/department.columns.code.label')),
                Tables\Columns\BadgeColumn::make('positions_count')
                    ->counts('positions')
                    ->label(__('jinzai::filament/resources/department.columns.job-positions.label')),
            ])
            ->filters([

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

    public static function getRelations(): array
    {
        return [
            RelationManagers\JobPositionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'view' => Pages\ViewDepartment::route('/{record}'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
