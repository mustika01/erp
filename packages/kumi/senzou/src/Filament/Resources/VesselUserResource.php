<?php

namespace Kumi\Senzou\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Kumi\Senzou\Filament\Resources\VesselUserResource\Pages;
use Kumi\Senzou\Models\VesselUser;
use Kumi\Senzou\Support\Enums\Position;
use Kumi\Sousa\Models\Vessel;

class VesselUserResource extends Resource
{
    protected static ?string $model = VesselUser::class;

    protected static ?string $navigationGroup = 'senzou';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'Users';

    protected static ?int $navigationSort = 4001;

    protected static ?string $slug = 'senzou/users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vessel_id')
                    ->relationship('vessel', 'name')
                    ->preload()
                    ->searchable()
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Select::make('position')
                    ->label(__('senzou::filament/resources/vessel-user.fields.position.label'))
                    ->options(self::getPositionOptions())
                    ->required()
                    ->reactive()
                    ->disabledOn('edit')
                    ->afterStateUpdated(function (\Closure $get, \Closure $set, string $state) {
                        $vessel = Vessel::query()->find($get('vessel_id'));

                        if (! $vessel) {
                            return;
                        }

                        $names = [
                            Position::NAHKODA => 'captain',
                            Position::KKM => 'engine',
                            Position::CHIEF_OFFICER => 'deck',
                        ];

                        $username = $names[$state];
                        $vesselName = Str::of($vessel->name)->squish()->replace(' ', '')->slug();
                        $email = "{$username}@{$vesselName}";

                        $set('email', $email);
                    }),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label(__('senzou::filament/resources/vessel-user.fields.email.label'))
                    ->required()
                    ->disabled(),
                Forms\Components\Textinput::make('password')
                    ->label(__('senzou::filament/resources/vessel-user.fields.password.label'))
                    ->password()
                    ->required(),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vessel.name')
                    ->label(__('senzou::filament/resources/vessel-user.columns.vessel.label')),
                Tables\Columns\TextColumn::make('position')
                    ->label(__('senzou::filament/resources/vessel-user.columns.position.label')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('senzou::filament/resources/vessel-user.columns.email.label')),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data) {
                        $data['password'] = Hash::make($data['password']);

                        return $data;
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListVesselUsers::route('/'),
            // 'create' => Pages\CreateVesselUser::route('/create'),
            // 'edit' => Pages\EditVesselUser::route('/{record}/edit'),
        ];
    }

    protected static function getPositionOptions(): array
    {
        return [
            Position::NAHKODA => __('senzou::filament/resources/vessel-user.fields.position.options.' . Position::NAHKODA),
            Position::KKM => __('senzou::filament/resources/vessel-user.fields.position.options.' . Position::KKM),
            Position::CHIEF_OFFICER => __('senzou::filament/resources/vessel-user.fields.position.options.' . Position::CHIEF_OFFICER),
        ];
    }
}
