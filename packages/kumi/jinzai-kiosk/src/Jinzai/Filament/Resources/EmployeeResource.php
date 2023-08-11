<?php

namespace Kumi\Jinzai\Filament\Resources;

use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Actions\GenerateEmployeeEmail;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages\EditEmployee;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages\ViewEmployee;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Support\DefaultPermissions;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Support\Enums\MaritalStatus;
use Kumi\Jinzai\Support\Enums\Religion;
use Livewire\Component as Livewire;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationGroup = 'jinzai';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2002;

    protected static ?string $slug = 'jinzai/employees';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema(self::getPersonalInformationSchema()),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('internal_id')
                    ->label(__('jinzai::filament/resources/employee.columns.internal_id.label'))
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('jinzai::filament/resources/employee.columns.name.label'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('jinzai::filament/resources/employee.columns.email.label'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->label(__('jinzai::filament/resources/employee.columns.mobile.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? "+{$state}" : null;
                    })
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('jinzai::filament/resources/employee.columns.gender.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? __('jinzai::filament/resources/employee.fields.gender.options.' . $state) : null;
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('marital_status')
                    ->label(__('jinzai::filament/resources/employee.columns.marital_status.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? __('jinzai::filament/resources/employee.fields.marital_status.options.' . $state) : null;
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('religion')
                    ->label(__('jinzai::filament/resources/employee.columns.religion.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? __('jinzai::filament/resources/employee.fields.religion.options.' . $state) : null;
                    })
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('gender')
                    ->label(__('jinzai::filament/resources/employee.filters.gender.label'))
                    ->options(self::getGenderOptions()),
                SelectFilter::make('marital_status')
                    ->label(__('jinzai::filament/resources/employee.filters.marital_status.label'))
                    ->options(self::getMaritalStatusOptions()),
                SelectFilter::make('religion')
                    ->label(__('jinzai::filament/resources/employee.filters.religion.label'))
                    ->options(self::getReligionOptions()),
                SelectFilter::make('department')
                    ->label(__('jinzai::filament/resources/employee.filters.department.label'))
                    ->options(self::getDepartmentOptions())
                    ->query(function (Builder $query, array $data): Builder {
                        $department = $data['value'];

                        return $department
                            ? $query->byDepartment($department)
                            : $query;
                    }),
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
            RelationManagers\IdentitiesRelationManager::class,
            RelationManagers\AddressesRelationManager::class,
            RelationManagers\RelativesRelationManager::class,
            RelationManagers\EmploymentsRelationManager::class,
            RelationManagers\ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }

    public static function getPersonalInformationSchema(): array
    {
        return [
            Forms\Components\Grid::make(4)
                ->schema([
                    Forms\Components\View::make('jinzai::filament.forms.layouts.generic')
                        ->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                                ->avatar(),
                        ])
                        ->extraAttributes(['class' => 'h-full flex items-center justify-center']),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->relationship('user')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label(__('jinzai::filament/resources/employee.relationships.user.fields.name.label'))
                                        ->reactive()
                                        ->afterStateUpdated(function (\Closure $set, ?string $state) {
                                            $set('email', GenerateEmployeeEmail::run($state));
                                        })
                                        ->required(),
                                    Forms\Components\TextInput::make('email')
                                        ->label(__('jinzai::filament/resources/employee.relationships.user.fields.email.label'))
                                        ->disabled()
                                        ->required()
                                        ->email()
                                        ->unique(ignorable: fn (?Model $record): ?Model => $record),
                                ])
                                ->disabled(function (Livewire $livewire) {
                                    return $livewire instanceof EditEmployee;
                                })
                                ->columnSpan(3),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('mobile')
                                        ->label(__('jinzai::filament/resources/employee.fields.mobile.label'))
                                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{62}00000000000'))
                                        ->numeric()
                                        ->nullable(),
                                    Forms\Components\TextInput::make('landline')
                                        ->label(__('jinzai::filament/resources/employee.fields.landline.label'))
                                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{62}00000000000'))
                                        ->numeric()
                                        ->nullable(),
                                ])->columnSpan(3),
                        ])->columnSpan(3),
                ]),
            Forms\Components\Grid::make(4)
                ->schema([
                    Forms\Components\Select::make('gender')
                        ->label(__('jinzai::filament/resources/employee.fields.gender.label'))
                        ->options(self::getGenderOptions())
                        ->required(),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('place_of_birth')
                                ->label(__('jinzai::filament/resources/employee.fields.place_of_birth.label'))
                                ->nullable(),
                            Forms\Components\DatePicker::make('date_of_birth')
                                ->label(__('jinzai::filament/resources/employee.fields.date_of_birth.label'))
                                ->displayFormat('d F Y')
                                ->closeOnDateSelection()
                                ->required(),
                        ])->columnSpan(3),
                ]),
            Forms\Components\Grid::make(4)
                ->schema([
                    Forms\Components\View::make('jinzai::filament.forms.layouts.generic')
                        ->schema([
                            Forms\Components\Select::make('blood_type')
                                ->label(__('jinzai::filament/resources/employee.fields.blood_type.label'))
                                ->options(self::getBloodTypeOptions())
                                ->nullable(),
                        ]),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('marital_status')
                                ->label(__('jinzai::filament/resources/employee.fields.marital_status.label'))
                                ->options(self::getMaritalStatusOptions())
                                ->required(),
                            Forms\Components\Select::make('religion')
                                ->label(__('jinzai::filament/resources/employee.fields.religion.label'))
                                ->options(self::getReligionOptions())
                                ->nullable(),
                        ])->columnSpan(3),
                ]),
            Forms\Components\Group::make([
                Forms\Components\View::make('filament-support::components.hr'),
                Forms\Components\Grid::make(9)
                    ->relationship('onboardingLink')
                    ->schema([
                        Forms\Components\Placeholder::make('onboarding_link')
                            ->label(__('jinzai::filament/resources/onboarding-link.fields.onboarding_link.label'))
                            ->content(function (?Model $record) {
                                return $record->getEditUrl();
                            })
                            ->columnSpan(8),
                        Forms\Components\View::make('jinzai::filament.forms.resources.onboarding-link.copy-onboarding-link-button')
                            ->columnSpan(1),
                    ])->disabled(),
            ])->visible(function (?Model $record, Livewire $livewire) {
                $user = Filament::auth()->user();

                return $livewire instanceof ViewEmployee
                    && $user->can(DefaultPermissions::VIEW_EMPLOYEE_ONBOARDING_LINK)
                    && $record->hasCreatedOnboardingLink()
                    && ! $record->hasBeenThroughOnboarding();
            }),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['user.name'];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->user->name;
    }

    protected static function getGenderOptions(): array
    {
        return [
            Gender::MALE => __('jinzai::filament/resources/employee.fields.gender.options.' . Gender::MALE),
            Gender::FEMALE => __('jinzai::filament/resources/employee.fields.gender.options.' . Gender::FEMALE),
        ];
    }

    protected static function getBloodTypeOptions(): array
    {
        return [
            BloodType::TYPE_A => __('jinzai::filament/resources/employee.fields.blood_type.options.' . BloodType::TYPE_A),
            BloodType::TYPE_B => __('jinzai::filament/resources/employee.fields.blood_type.options.' . BloodType::TYPE_B),
            BloodType::TYPE_AB => __('jinzai::filament/resources/employee.fields.blood_type.options.' . BloodType::TYPE_AB),
            BloodType::TYPE_O => __('jinzai::filament/resources/employee.fields.blood_type.options.' . BloodType::TYPE_O),
        ];
    }

    protected static function getMaritalStatusOptions(): array
    {
        return [
            MaritalStatus::SINGLE => __('jinzai::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::SINGLE),
            MaritalStatus::MARRIED => __('jinzai::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::MARRIED),
            MaritalStatus::WIDOW => __('jinzai::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::WIDOW),
            MaritalStatus::WIDOWER => __('jinzai::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::WIDOWER),
        ];
    }

    protected static function getReligionOptions(): array
    {
        return [
            Religion::CATHOLIC => __('jinzai::filament/resources/employee.fields.religion.options.' . Religion::CATHOLIC),
            Religion::ISLAM => __('jinzai::filament/resources/employee.fields.religion.options.' . Religion::ISLAM),
            Religion::CHRISTIAN => __('jinzai::filament/resources/employee.fields.religion.options.' . Religion::CHRISTIAN),
            Religion::BUDDHA => __('jinzai::filament/resources/employee.fields.religion.options.' . Religion::BUDDHA),
            Religion::HINDU => __('jinzai::filament/resources/employee.fields.religion.options.' . Religion::HINDU),
            Religion::CONFUCIOUS => __('jinzai::filament/resources/employee.fields.religion.options.' . Religion::CONFUCIOUS),
            Religion::OTHERS => __('jinzai::filament/resources/employee.fields.religion.options.' . Religion::OTHERS),
        ];
    }

    protected static function getDepartmentOptions(): array
    {
        return Department::all()
            ->mapWithKeys(function (Department $department) {
                return [$department->id => $department->name];
            })->toArray();
    }
}
