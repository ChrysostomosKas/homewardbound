<?php

namespace App\Livewire;

use App\Models\AdoptionInterest;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class AdoptionInterestForm extends Component implements HasForms
{
    use InteractsWithForms;

    public AdoptionInterest $adoptionInterest;
    public string $adoption_ad_id;
    public string $contact_phone_number = '';
    public string $city = '';
    public string $address = '';
    public string $animal_giveup_history = '';
    public string $existing_pets = '';
    public bool $family_agreement_for_animal = false;
    public string $contact_birth_date = '';
    public string $zip_code = '';
    public string $contact_email = '';

    public function mount($ad_id = null): void
    {
        $this->adoption_ad_id = $ad_id;

        if ($ad_id) {
            $user = auth()->user();

            $this->adoptionInterest = $this->makeBlankAdoptionInterestForm();

            $this->form->fill([
                'contact_phone_number' => $user->phone,
                'city' => $user->city,
                'zip_code' => $user->zip_code,
                'contact_email' => $user->email,
                'address' => $user->address,
                'animal_giveup_history' => '',
                'existing_pets' => '',
                'contact_birth_date' => $user->birth_date ?? now(),
                'family_agreement_for_animal' => false,
            ]);
        }
    }

    public function makeBlankAdoptionInterestForm()
    {
        return AdoptionInterest::make(['created_at' => now()]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make(__('Let Us Know You are Interested in Adopting'))
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextInput::make('city')
                                ->label(__('City'))
                                ->columnSpan(1)
                                ->required()
                                ->dehydrated(fn () => true),
                            TextInput::make('address')
                                ->label('Address')
                                ->columnSpan(1)
                                ->required(),
                            TextInput::make('zip_code')
                                ->label('Zip Code')
                                ->columnSpan(1)
                                ->required()
                                ->dehydrated(fn () => true),
                        ]),
                    Grid::make(3)
                        ->schema([
                            TextInput::make('contact_phone_number')
                                ->label(__('Contact phone-number'))
                                ->columnSpan(1)
                                ->required()
                                ->dehydrated(fn () => true),
                            TextInput::make('contact_email')
                                ->label(__('Contact email'))
                                ->columnSpan(1)
                                ->email()
                                ->required()
                                ->dehydrated(fn () => true),
                            DatePicker::make('contact_birth_date')
                                ->label(__('Contact Birth Date'))
                                ->columnSpan(1)
                                ->required()
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('animal_giveup_history')
                                ->label(__('Have you ever given up an animal that you could no longer care for?'))
                                ->columnSpan(1)
                                ->required()
                                ->dehydrated(fn () => true),
                            TextInput::make('existing_pets')
                                ->label(__('Have you had other pets?'))
                                ->columnSpan(1)
                                ->required()
                                ->dehydrated(fn () => true)
                        ]),
                    Grid::make(1)
                        ->schema([
                            Checkbox::make('family_agreement_for_animal')
                                ->label(__('Do all members of your family agree to getting an animal?'))
                                ->columnSpan(1)
                                ->required()
                                ->dehydrated(fn () => true)
                        ]),
                ])
        ];
    }

    /**
     *
     */
    public function saveAdoptionInterest()
    {
        $new_adoptionInterest = AdoptionInterest::updateOrCreate(
            ['id' => $this->adoptionInterest->id],
            $this->form->getState() + [
                'adoption_ad_id' => $this->adoption_ad_id,
                'user_id' => auth()->id()
            ]
        );

        if ($new_adoptionInterest->id) {
            $this->dispatch('notification', [
                'success' => true,
                'message' => __('We appreciate your interest! Our team will contact you soon.'),
                'delay' => 5000
            ]);
        } else {
            $this->dispatch('notification', [
                'success' => false,
                'message' => __('Something went wrong!'),
                'delay' => 5000
            ]);
        }

        return redirect()->route('adoption-interests.index');
    }

    public function render()
    {
        return view('livewire.adoption-interest-form');
    }
}
