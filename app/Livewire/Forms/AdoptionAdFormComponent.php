<?php

namespace App\Livewire\Forms;

use App\Enums\AdoptionAdStatus;
use App\Enums\PetCategory;
use App\Models\AdoptionAd;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AdoptionAdFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public AdoptionAd $adoptionAd;
    public string $title = '';
    public string $description = '';
    public int $age = 0;
    public string $size = '';
    public string $color = '';
    public string $gender = '';
    public string $breed = '';
    public string $type_of_pet = '';
    public bool $vaccination_status = false;
    public bool $spaying_neutering_status = false;
    public string $health_condition = '';
    public string $location = '';
    public string $contact_phone_number = '';
    public string $contact_email = '';
    public string $ad_id = '';

    protected function rules(): array
    {
        return [
            'title'                    => 'required | string | max:255',
            'description'              => 'required | string | max:255',
            'age'                      => 'nullable | integer | max:255',
            'size'                     => 'nullable | string | max:255',
            'color'                    => 'nullable | string | max:255',
            'gender'                   => 'required | string | max:255',
            'breed'                    => 'required | string | max:255',
            'vaccination_status'       => 'required',
            'spaying_neutering_status' => 'required',
            'health_condition'         => 'required | string | max:255',
            'location'                 => 'required | string | max:255',
            'contact_phone_number'     => 'required | string | max:255',
            'type_of_pet'              => 'required',
            'contact_email'            => 'required | string | max:255'
        ];
    }

    public function mount($ad_id = null): void
    {
        if ($this->ad_id) {
            $this->adoptionAd = AdoptionAd::query()
                ->where('id', '=', $ad_id)
                ->first();

            $this->form->fill([
                'title' => $this->adoptionAd->title,
                'description' => $this->adoptionAd->description,
                'age' => $this->adoptionAd->age,
                'size' => $this->adoptionAd->size,
                'color' => $this->adoptionAd->color,
                'gender' => $this->adoptionAd->gender,
                'breed' => $this->adoptionAd->breed,
                'vaccination_status' => $this->adoptionAd->vaccination_status,
                'spaying_neutering_status' => $this->adoptionAd->spaying_neutering_status,
                'health_condition' => $this->adoptionAd->health_condition,
                'location' => $this->adoptionAd->location,
                'contact_phone_number' => $this->adoptionAd->contact_phone_number,
                'type_of_pet' => $this->adoptionAd->type_of_pet->name,
                'contact_email' => $this->adoptionAd->contact_email,
            ]);
        } else {
            $this->form->fill([
                'title' => $this->title,
                'description' => $this->description,
                'age' => $this->age,
                'size' => $this->size,
                'color' => $this->color,
                'gender' => $this->gender,
                'breed' => $this->breed,
                'vaccination_status' => $this->vaccination_status,
                'spaying_neutering_status' => $this->spaying_neutering_status,
                'health_condition' => $this->health_condition,
                'location' => $this->location,
                'contact_phone_number' => $this->contact_phone_number,
                'type_of_pet' => $this->type_of_pet,
                'contact_email' => $this->contact_email,
            ]);
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Be a Hero for Pets: Create an Adoption Ad')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->columnSpan(1)
                                ->required(),
                            Select::make('breed')
                                ->label('Breed')
                                ->options([
                                    'DogBreed' => 'Dog',
                                    'CatBreed' => 'Cat',
                                    'BirdBreed' => 'Bird',
                                    'FishBreed' => 'Fish',
                                    'RabbitBreed' => 'Rabbit',
                                    'HamsterBreed' => 'Hamster',
                                    'ReptileBreed' => 'Reptile',
                                    'AmphibianBreed' => 'Amphibian',
                                    'HorseBreed' => 'Horse'
                                ])
                                ->required()
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('age')
                                ->label('Age')
                                ->columnSpan(1)
                                ->integer()
                                ->minValue(0)
                                ->maxValue(40)
                                ->nullable(),
                            TextInput::make('size')
                                ->label('Size')
                                ->columnSpan(1)
                                ->required()
                        ]),
                    Grid::make(2)
                        ->schema([
                            Select::make('gender')
                                ->label('Gender')
                                ->options([
                                    'male' => 'Male',
                                    'Female' => 'female'
                                ])
                                ->required(),
                            TextInput::make('color')
                                ->label('Color')
                                ->columnSpan(1)
                                ->nullable()
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('health_condition')
                                ->label('Health Condition')
                                ->columnSpan(1)
                                ->required(),
                            TextInput::make('location')
                                ->label('Location')
                                ->columnSpan(1)
                                ->required()
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('contact_phone_number')
                                ->label('Contact phone-number')
                                ->columnSpan(1)
                                ->required(),
                            TextInput::make('contact_email')
                                ->label('Contact email')
                                ->columnSpan(1)
                                ->email()
                                ->required()
                        ]),
                    Grid::make(1)
                        ->schema([
                            Select::make('type_of_pet')
                                ->label('Type of pet')
                                ->options([
                                    'Dog' => 'Dog',
                                    'Cat' => 'Cat',
                                    'Bird' => 'Bird',
                                    'Fish' => 'Fish',
                                    'Rabbit' => 'Rabbit',
                                    'Hamster' => 'Hamster',
                                    'Reptile' => 'Reptile',
                                    'Amphibian' => 'Amphibian',
                                    'Horse' => 'Horse'
                                ])
                                ->required()
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('description')
                                ->label('Description')
                                ->columnSpan(1)
                                ->rows(10)
                                ->cols(10)
                                ->required()
                        ]),
                    Grid::make(2)
                        ->schema([
                            Checkbox::make('vaccination_status')
                                ->label('Vaccination Status')
                                ->inline(),
                            Checkbox::make('spaying_neutering_status')
                                ->label('Spaying Neutering Status')
                                ->inline()
                        ]),
                ])
        ];
    }

    /**
     * @throws ValidationException
     */
    public function saveAdoptionAd()
    {
        $this->validate();
        $allPetTypes = PetCategory::all();
        $randomPetType = $allPetTypes[array_rand($allPetTypes)];

        if (!isset($this->adoptionAd->id)) {
            $this->adoptionAd = new AdoptionAd();
        }

        $this->adoptionAd->fill([
            'title' => $this->title,
            'description' => $this->description,
            'age' => $this->age,
            'size' => $this->size,
            'color' => $this->color,
            'gender' => $this->gender,
            'breed' => $this->breed,
            'vaccination_status' => $this->vaccination_status,
            'spaying_neutering_status' => $this->spaying_neutering_status,
            'health_condition' => $this->health_condition,
            'location' => $this->location,
            'contact_phone_number' => $this->contact_phone_number,
            'type_of_pet' => PetCategory::fromCase($this->type_of_pet),
            'contact_email' => $this->contact_email,
            'status' => AdoptionAdStatus::Open->name,
        ]);

        $this->adoptionAd->save();

        if ($this->adoptionAd->id) {
            $this->dispatch('notification', [
                'success' => true,
                'message' => __('Your changes have been successfully saved!'),
                'delay' => 5000
            ]);
        } else {
            $this->dispatch('notification', [
                'success' => false,
                'message' => __('Something went wrong!'),
                'delay' => 5000
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.forms.adoption-ad-form-component');
    }
}
