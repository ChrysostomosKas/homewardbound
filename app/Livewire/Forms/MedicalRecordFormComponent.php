<?php

namespace App\Livewire\Forms;

use App\Models\MedicalRecord;
use App\Models\Pet;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
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
            Section::make('Pet Form')
                ->description('Provide some information about your pet.')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')
                                ->label('Name')
                                ->columnSpan(1)
                                ->required(),
                            TextInput::make('species')
                                ->label('Species')
                                ->columnSpan(1)
                                ->required(),
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('breed')
                                ->label('Breed')
                                ->columnSpan(1)
                                ->required(),
                            TextInput::make('age')
                                ->label('Age')
                                ->integer()
                                ->columnSpan(1)
                                ->required(),
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('weight')
                                ->label('Weight')
                                ->integer()
                                ->minValue(0)
                                ->columnSpan(1)
                                ->nullable(),
                            TextInput::make('color')
                                ->label('Color')
                                ->columnSpan(1)
                                ->nullable(),
                        ]),
                    Grid::make(1)
                        ->schema([
                            TextInput::make('microchip_number')
                                ->label('Microchip Number')
                                ->columnSpan(1)
                                ->nullable()
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('special_needs')
                                ->label('Special Needs')
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ])
                ]),
            Section::make('Pet Medical Record Form')
                ->description('Provide the following information about the pets medical history.')
                ->schema([
                    Grid::make(1)
                        ->schema([
                            Textarea::make('medical_history')
                                ->label('Medical History')
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('medications')
                                ->label('Medications')
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('allergies')
                                ->label('Allergies')
                                ->columnSpan(1)
                                ->rows(5)
                                ->cols(5)
                                ->nullable()
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('emergency_contact_number')
                                ->label('Emergency Contact Number')
                                ->columnSpan(1)
                                ->nullable(),
                            DatePicker::make('spaying_neutering_date')
                                ->label('Spaying Neutering Date')
                                ->columnSpan(1)
                                ->required(),
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('behavioral_notes')
                                ->label('Behavioral Notes')
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
