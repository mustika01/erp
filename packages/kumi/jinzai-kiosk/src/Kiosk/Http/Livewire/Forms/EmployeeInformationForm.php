<?php

namespace Kumi\Kiosk\Http\Livewire\Forms;

use Filament\Forms;
use Livewire\Component;
use Kumi\Jinzai\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Livewire\Component as Livewire;
use Illuminate\Support\Facades\Auth;
use Kumi\Jinzai\Support\Enums\Gender;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\Enums\Religion;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\MaritalStatus;
use Filament\Forms\Concerns\InteractsWithForms;

class EmployeeInformationForm extends Component implements HasForms
{
    use InteractsWithForms;

    public function mount(): void
    {
        $attributes = Collection::make([
            'mobile',
            'landline',
            'gender',
            'place_of_birth',
            'date_of_birth',
            'blood_type',
            'marital_status',
            'religion',
        ])->mapWithKeys(function (string $attribute) {
            return [$attribute => $this->getFormModel()->getAttribute($attribute)];
        })->toArray();

        $this->form->fill($attributes);
    }

    public function render(): View
    {
        return view('kiosk::livewire.forms.employee-information');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make()
                ->schema(self::getPersonalInformationSchema())
                ->disabled(),
        ];
    }

    protected static function getPersonalInformationSchema(): array
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
        ];
    }

    protected function getFormModel(): Employee
    {
        return Auth::user()->employee;
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
}
