<?php

namespace Kumi\Kyoka\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Kumi\Kyoka\Models\Role;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Kumi\Kyoka\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Filament\Resources\RoleResource\Pages;
use Kumi\Kyoka\Filament\Resources\RoleResource\Tables\Actions as ResourceActions;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'kyoka';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 9002;

    protected static ?string $slug = 'kyoka/roles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('label')
                        ->required(),
                    Forms\Components\Textarea::make('description'),
                ]),
                static::getPermissionsTabsSchema(),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label(__('kyoka::filament/resources/role.columns.label.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('kyoka::filament/resources/role.columns.description.label'))
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('permissions_count')
                    ->label(__('kyoka::filament/resources/role.columns.permissions.label'))
                    ->counts('permissions'),
                Tables\Columns\BadgeColumn::make('users_count')
                    ->label(__('kyoka::filament/resources/role.columns.users.label'))
                    ->getStateUsing(function (Model $record): string {
                        return $record->users()->withoutSensitive()->count();
                    }),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                ResourceActions\EditAction::make(),
                ResourceActions\DeleteAction::make(),
            ])
            ->bulkActions([
                ResourceActions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view' => Pages\ViewRole::route('/{record}'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    protected static function getPermissionsTabsSchema()
    {
        $tabs = Permission::all()
            ->groupBy('namespace')
            ->reject(function ($permissions, $namespace) {
                return empty($namespace);
            })
            ->map
            ->groupBy('group')
            ->map(function ($groups, $namespace) {
                $fieldsets = $groups->map(function ($permissions, $group) {
                    $toggles = $permissions->map(function ($permission) {
                        return Forms\Components\Toggle::make("permissions.{$permission->name}")
                            ->label($permission->label)
                            ->reactive()
                            ->afterStateHydrated(function (Closure $set, ?Model $record) use ($permission) {
                                if ($record) {
                                    $set("permissions.{$permission->name}", $record->hasPermissionTo($permission->name));
                                }
                            })
                        ;
                    });

                    return Forms\Components\Fieldset::make(Str::headline($group))
                        ->schema([
                            Forms\Components\Grid::make()->schema($toggles->all()),
                        ])
                        ->columnSpan(1)
                        ->extraAttributes(['class' => 'h-full'])
                    ;
                });

                return Forms\Components\Tabs\Tab::make(Str::headline($namespace))
                    ->schema([
                        Forms\Components\Grid::make()->schema($fieldsets->all()),
                    ])
                ;
            })
            ->values()
        ;

        return Forms\Components\Tabs::make('Permissions')
            ->tabs($tabs->all())
            ->columnSpan('full')
        ;
    }
}
