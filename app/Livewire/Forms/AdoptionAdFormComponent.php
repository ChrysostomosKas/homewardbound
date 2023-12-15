<?php

namespace App\Livewire\Forms;

use App\Models\AdoptionAd;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
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
    public string $pet_age_unit = '';
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
    public $base_image = '';

    public function mount($ad_id = null): void
    {
        if ($ad_id) {
            $this->adoptionAd = AdoptionAd::find($ad_id);

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
                'base_image' => $this->adoptionAd->base_image,
            ]);
        } else {
            $this->form->fill([
                'title' => '',
                'description' => '',
                'age' => 0,
                'size' => '',
                'color' => '',
                'gender' => '',
                'breed' => '',
                'vaccination_status' => false,
                'spaying_neutering_status' => false,
                'health_condition' => '',
                'location' => '',
                'contact_phone_number' => '',
                'type_of_pet' => '',
                'contact_email' => '',
                'base_image' => '',
                'pet_age_unit' => ''
            ]);

            $this->adoptionAd = $this->makeBlankAdoptionAdForm();
        }
    }


    public function makeBlankAdoptionAdForm()
    {
        return AdoptionAd::make(['created_at' => now()]);
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
                    Grid::make(2)
                        ->schema([
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
                                ->required(),
                            Select::make('gender')
                                ->label('Gender')
                                ->options([
                                    'male' => 'Male',
                                    'Female' => 'female'
                                ])
                                ->required(),
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
                            Select::make('pet_age_unit')
                                ->label('Pet Age Unit')
                                ->columnSpan(1)
                                ->options([
                                    'Months' => 'Months',
                                    'Years' => 'Years'
                                ])
                                ->required(),
                        ]),
                    Grid::make(2)
                        ->schema([
                            Select::make('size')
                                ->label('Size')
                                ->columnSpan(1)
                                ->options([
                                    'Small' => 'Small',
                                    'Medium' => 'Medium',
                                    'Large' => 'Large',
                                    'extra_large' => 'Extra Large'
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
                            Textarea::make('description')
                                ->label('Description')
                                ->columnSpan(1)
                                ->rows(10)
                                ->cols(10)
                                ->required()
                        ]),
                    Grid::make(1)
                        ->schema([
                            FileUpload::make('base_image')
                                ->label('Image')
                                ->image()
                                ->columnSpan(1)
                                ->nullable(),
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
        $new_adoptionAd = AdoptionAd::updateOrCreate(
            ['id' => $this->adoptionAd->id],
            $this->form->getState()
        );

        if ($new_adoptionAd->id) {
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