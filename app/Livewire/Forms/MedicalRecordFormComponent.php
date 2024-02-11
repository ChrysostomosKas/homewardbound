<?php

namespace App\Livewire\Forms;

use App\Models\AmphibianBreed;
use App\Models\BirdBreed;
use App\Models\CatBreed;
use App\Models\DogBreed;
use App\Models\FishBreed;
use App\Models\HamsterBreed;
use App\Models\HorseBreed;
use App\Models\MedicalRecord;
use App\Models\Pet;
use App\Models\RabbitBreed;
use App\Models\ReptileBreed;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class MedicalRecordFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public MedicalRecord $medicalRecord;
    public Pet $pet;
    public string $medical_history = '';
    public string $medications = '';
    public string $allergies = '';
    public string $emergency_contact_number = '';
    public string $spaying_neutering_date = '';
    public string $behavioral_notes = '';
    public string $name = '';
    public string $species = '';
    public string $breed = '';
    public string $age = '';
    public string $weight = '';
    public string $color = '';
    public string $special_needs = '';
    public string $microchip_number = '';

    public function mount($medicalForm_id = null): void
    {
        if ($medicalForm_id) {
            $this->medicalRecord = MedicalRecord::find($medicalForm_id);
            $this->pet = Pet::find($this->medicalRecord->pet_id);

            $this->form->fill([
                'medical_history' => $this->medicalRecord->medical_history,
                'medications' => $this->medicalRecord->medications,
                'allergies' => $this->medicalRecord->allergies,
                'emergency_contact_number' => $this->medicalRecord->emergency_contact_number,
                'spaying_neutering_date' => $this->medicalRecord->spaying_neutering_date,
                'behavioral_notes' => $this->medicalRecord->behavioral_notes,
                'name' => $this->pet->name,
                'species' => $this->pet->species,
                'breed' => $this->pet->breed,
                'age' => $this->pet->age,
                'weight' => $this->pet->weight,
                'color' => $this->pet->color,
                'special_needs' => $this->pet->special_needs,
                'microchip_number' => $this->pet->microchip_number
            ]);
        } else {
            $this->form->fill([
                'medical_history' => '',
                'medications' => '',
                'allergies' => '',
                'emergency_contact_number' => '',
                'spaying_neutering_date' => '',
                'behavioral_notes' => '',
                'name' => '',
                'species' => '',
                'breed' => '',
                'age' => '',
                'weight' => '',
                'color' => '',
                'special_needs' => '',
                'microchip_number' => ''
            ]);

            $this->medicalRecord = $this->makeBlankMedicalRecordForm();
            $this->pet = $this->makeBlankPetForm();
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make(__('Pet Name'))
                ->description(__('Provide some information about your pet.'))
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->columnSpan(1)
                                ->required(),
                            Select::make('species')
                                ->label(__('Species'))
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
                                ->preload()
                                ->live(),
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('age')
                                ->label(__('Age'))
                                ->integer()
                                ->columnSpan(1)
                                ->required(),
                            TextInput::make('weight')
                                ->label(__('Weight'))
                                ->integer()
                                ->minValue(0)
                                ->columnSpan(1)
                                ->nullable(),
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('color')
                                ->label(__('Color'))
                                ->columnSpan(1)
                                ->nullable(),
                            TextInput::make('microchip_number')
                                ->label(__('Microchip Number'))
                                ->columnSpan(1)
                                ->nullable()
                        ]),
                        ]),
                    Grid::make(1)
                        ->schema([
                    Select::make('breed')
                        ->label(__('Breed'))
                        ->options(fn(Get $get): Collection =>
                        match ($get('species')) {
                            'Dog' => DogBreed::pluck('name_en', 'name_en'),
                            'Cat' => CatBreed::pluck('name_en', 'name_en'),
                            'Bird' => BirdBreed::pluck('name_en', 'name_en'),
                            'Fish' => FishBreed::pluck('name_en', 'name_en'),
                            'Rabbit' => RabbitBreed::pluck('name_en', 'name_en'),
                            'Hamster' => HamsterBreed::pluck('name_en', 'name_en'),
                            'Reptile' => ReptileBreed::pluck('name_en', 'name_en'),
                            'Amphibian' => AmphibianBreed::pluck('name_en', 'name_en'),
                            'Horse' => HorseBreed::pluck('name_en', 'name_en'),
                            default => collect([]),
                        })
                        ->required(),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('special_needs')
                                ->label(__('Special Needs'))
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ])
                ]),
            Section::make(__('Pet Medical Record Form'))
                ->description(__('Provide the following information about the pets medical history.'))
                ->schema([
                    Grid::make(1)
                        ->schema([
                            Textarea::make('medical_history')
                                ->label(__('Medical History'))
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('medications')
                                ->label(__('Medications'))
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('allergies')
                                ->label(__('Allergies'))
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('emergency_contact_number')
                                ->label(__('Emergency Contact Number'))
                                ->columnSpan(1)
                                ->nullable(),
                            DatePicker::make('spaying_neutering_date')
                                ->label(__('Spaying Neutering Date'))
                                ->columnSpan(1)
                                ->required(),
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('behavioral_notes')
                                ->label(__('Behavioral Notes'))
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ]),
                ])
        ];
    }

    public function makeBlankMedicalRecordForm()
    {
        return MedicalRecord::make(['created_at' => now()]);
    }

    public function makeBlankPetForm()
    {
        return Pet::make(['created_at' => now()]);
    }

    /**
     * @throws ValidationException
     */
    public function saveMedicalRecord()
    {
        $formFields = $this->form->getState();
        $medicalRecordFields = ['medical_history', 'medications', 'allergies', 'emergency_contact_number', 'spaying_neutering_date', 'behavioral_notes'];
        $petFields = ['name', 'species', 'breed', 'age', 'weight', 'color', 'special_needs', 'microchip_number'];

        $medicalRecordData = array_intersect_key($formFields, array_flip($medicalRecordFields));
        $petData = array_intersect_key($formFields, array_flip($petFields));

        $petData['user_id'] = auth()->id();

        $new_pet = Pet::updateOrCreate(
            ['id' => $this->pet->id],
            $petData
        );

        $medicalRecordData['pet_id'] = $new_pet->id;

        $new_medicalRecord = MedicalRecord::updateOrCreate(
            ['id' => $this->medicalRecord->id],
            $medicalRecordData
        );

        if ($new_medicalRecord->id) {
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
        return view('livewire.forms.medical-record-form-component');
    }
}
