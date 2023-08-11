<?php

namespace Kumi\Norikumi\Http\Livewire\Forms;

use Closure;
use Filament\Forms;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Redirect;
use Filament\Forms\Concerns\InteractsWithForms;
use Kumi\Norikumi\Models\RegistrationFormEntry;
use Kumi\Norikumi\Support\Enums\CertificationType;

class RegistrationForm extends Component implements HasForms
{
    use InteractsWithForms;

    public RegistrationFormEntry $entry;

    public function mount(RegistrationFormEntry $entry): void
    {
        $this->entry = $entry;

        $this->form->fill([
            'name' => $this->entry->name,
        ]);
    }

    public function render(): View
    {
        return view('norikumi::livewire.forms.registration');
    }

    public function update()
    {
        $data = $this->form->getState();

        if ($data['certification_type'] == CertificationType::CERTIFICATE) {
            unset(
                $data['properties.ratings_or_able_number'],
                $data['properties.ratings_or_able_expiry_date'],
            );
        }

        if ($data['certification_type'] == CertificationType::RATINGS_OR_ABLE) {
            unset(
                $data['properties.certificate_level'],
                $data['properties.certificate_number'],
                $data['properties.endorsement_number'],
                $data['properties.endorsement_expiry_date'],
            );
        }

        unset($data['certification_type']);

        $data['completed_at'] = Carbon::now();

        $this->entry->update($data);

        return Redirect::route('norikumi.registration-form-entry.complete');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Wizard::make([
                Forms\Components\Wizard\Step::make(__('norikumi::filament/forms/registration.steps.personal'))
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.name.label'))
                                    ->disabled()
                                    ->required(),
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('properties.email')
                                            ->label(__('norikumi::filament/resources/registration-form-entry.fields.email.label'))
                                            ->email()
                                            ->required(),
                                        Forms\Components\TextInput::make('properties.mobile_number')
                                            ->label(__('norikumi::filament/resources/registration-form-entry.fields.mobile_number.label'))
                                            ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{62}00000000000'))
                                            ->required(),
                                    ]),
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('properties.place_of_birth')
                                            ->label(__('norikumi::filament/resources/registration-form-entry.fields.place_of_birth.label'))
                                            ->required(),
                                        Forms\Components\DatePicker::make('properties.date_of_birth')
                                            ->label(__('norikumi::filament/resources/registration-form-entry.fields.date_of_birth.label'))
                                            ->displayFormat('d F Y')
                                            ->required(),
                                    ]),
                                Forms\Components\Select::make('properties.gender')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.gender.label'))
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('properties.marriage_status')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.marriage_status.label'))
                                    ->options([
                                        'single' => 'Single',
                                        'married' => 'Married',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('properties.identity_card_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.identity_card_number.label'))
                                    ->required()
                                    ->rules(['digits:16']),
                                Forms\Components\TextInput::make('properties.family_card_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.family_card_number.label'))
                                    ->required()
                                    ->rules(['digits:16']),
                                Forms\Components\Section::make(__('norikumi::filament/forms/registration.sections.equipment_sizing'))
                                    ->schema([
                                        Forms\Components\Grid::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('properties.wearpack_size')
                                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.wearpack_size.label'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('properties.safety_shoes_size')
                                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.safety_shoes_size.label'))
                                                    ->numeric()
                                                    ->mask(
                                                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                            ->numeric()
                                                    )
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),
                    ]),
                Forms\Components\Wizard\Step::make(__('norikumi::filament/forms/registration.steps.bank'))
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('properties.account_name')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.account_name.label'))
                                    ->required(),
                                Forms\Components\TextInput::make('properties.bank_name')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.bank_name.label'))
                                    ->required(),
                                Forms\Components\TextInput::make('properties.account_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.account_number.label'))
                                    ->required(),
                                Forms\Components\TextInput::make('properties.tax_card_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.tax_card_number.label'))
                                    ->mask(
                                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                                            ->numeric()
                                            ->pattern('00.000.000.0-000.000')
                                    )
                                    ->required(),
                            ]),
                    ]),
                Forms\Components\Wizard\Step::make(__('norikumi::filament/forms/registration.steps.documents'))
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Select::make('certification_type')
                                            ->label(__('norikumi::filament/resources/registration-form-entry.fields.certification_type.label'))
                                            ->options([
                                                CertificationType::CERTIFICATE => __('norikumi::filament/resources/registration-form-entry.fields.certification_type.options.' . CertificationType::CERTIFICATE),
                                                CertificationType::RATINGS_OR_ABLE => __('norikumi::filament/resources/registration-form-entry.fields.certification_type.options.' . CertificationType::RATINGS_OR_ABLE),
                                            ])
                                            ->reactive()
                                            ->afterStateUpdated(function (Closure $set, string $state) {
                                                if ($state == CertificationType::CERTIFICATE) {
                                                    $set('properties.ratings_or_able_number', null);
                                                    $set('properties.ratings_or_able_expiry_date', null);
                                                }

                                                if ($state == CertificationType::RATINGS_OR_ABLE) {
                                                    $set('properties.certificate_level', null);
                                                    $set('properties.certificate_number', null);
                                                    $set('properties.endorsement_number', null);
                                                    $set('properties.endorsement_expiry_date', null);
                                                }
                                            })
                                            ->required(),
                                    ]),
                                Forms\Components\TextInput::make('properties.certificate_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.certificate_number.label'))
                                    ->required(function (Closure $get) {
                                        return $get('certification_type') == CertificationType::CERTIFICATE;
                                    }),
                                Forms\Components\TextInput::make('properties.certificate_level')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.certificate_level.label'))
                                    ->required(function (Closure $get) {
                                        return $get('certification_type') == CertificationType::CERTIFICATE;
                                    }),
                                Forms\Components\TextInput::make('properties.endorsement_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.endorsement_number.label'))
                                    ->required(function (Closure $get) {
                                        return $get('certification_type') == CertificationType::CERTIFICATE;
                                    }),
                                Forms\Components\DatePicker::make('properties.endorsement_expiry_date')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.endorsement_expiry_date.label'))
                                    ->displayFormat('d F Y')
                                    ->minDate(Carbon::now())
                                    ->maxDate(Carbon::now()->addYears(10))
                                    ->required(function (Closure $get) {
                                        return $get('certification_type') == CertificationType::CERTIFICATE;
                                    }),
                                Forms\Components\TextInput::make('properties.ratings_or_able_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.ratings_or_able_number.label'))
                                    ->required(function (Closure $get) {
                                        return $get('certification_type') == CertificationType::RATINGS_OR_ABLE;
                                    }),
                                Forms\Components\DatePicker::make('properties.ratings_or_able_expiry_date')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.ratings_or_able_expiry_date.label'))
                                    ->displayFormat('d F Y')
                                    ->minDate(Carbon::now())
                                    ->maxDate(Carbon::now()->addYears(10))
                                    ->required(function (Closure $get) {
                                        return $get('certification_type') == CertificationType::RATINGS_OR_ABLE;
                                    }),
                                Forms\Components\TextInput::make('properties.basic_safety_training_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.basic_safety_training_number.label'))
                                    ->required(),
                                Forms\Components\DatePicker::make('properties.basic_safety_training_expiry_date')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.basic_safety_training_expiry_date.label'))
                                    ->displayFormat('d F Y')
                                    ->minDate(Carbon::now())
                                    ->maxDate(Carbon::now()->addYears(10))
                                    ->required(),
                                Forms\Components\TextInput::make('properties.seafarer_book_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.seafarer_book_number.label'))
                                    ->required(),
                                Forms\Components\DatePicker::make('properties.seafarer_book_expiry_date')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.seafarer_book_expiry_date.label'))
                                    ->displayFormat('d F Y')
                                    ->minDate(Carbon::now())
                                    ->maxDate(Carbon::now()->addYears(10))
                                    ->required(),
                            ]),
                    ]),
                Forms\Components\Wizard\Step::make(__('norikumi::filament/forms/registration.steps.emergency_contact'))
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('properties.emergency_contact_name')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.emergency_contact_name.label'))
                                    ->required(),
                                Forms\Components\TextInput::make('properties.emergency_contact_number')
                                    ->label(__('norikumi::filament/resources/registration-form-entry.fields.emergency_contact_number.label'))
                                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{62}00000000000'))
                                    ->required(),
                            ]),
                    ]),
            ])->submitAction(view('norikumi::livewire.forms.registration.submit-button')),
        ];
    }

    protected function getFormModel(): RegistrationFormEntry
    {
        return $this->entry;
    }
}
