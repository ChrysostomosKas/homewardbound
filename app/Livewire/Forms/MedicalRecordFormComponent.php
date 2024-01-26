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
    public string $medical_history = '';
    public string $medications = '';
    public string $allergies = '';
    public string $emergency_contact_number = '';
    public string $spaying_neutering_date = '';
    public string $behavioral_notes = '';

    public function mount($medicalForm_id = null): void
    {
        if ($medicalForm_id) {
            $this->medicalRecord = MedicalRecord::find($medicalForm_id);

            $this->form->fill([
                'medical_history' => $this->medicalRecord->medical_history,
                'medications' => $this->medicalRecord->medications,
                'allergies' => $this->medicalRecord->allergies,
                'emergency_contact_number' => $this->medicalRecord->emergency_contact_number,
                'spaying_neutering_date' => $this->medicalRecord->spaying_neutering_date,
                'behavioral_notes' => $this->medicalRecord->behavioral_notes
            ]);
        } else {
            $this->form->fill([
                'medical_history' => '',
                'medications' => '',
                'allergies' => '',
                'emergency_contact_number' => '',
                'spaying_neutering_date' => '',
                'behavioral_notes' => '',
            ]);

            $this->medicalRecord = $this->makeBlankMedicalRecordForm();
        }
    }

    protected function getFormSchema(): array
    {
        return [
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

    /**
     * @throws ValidationException
     */
    public function saveMedicalRecord()
    {
        $new_medicalRecord = MedicalRecord::updateOrCreate(
            ['id' => $this->medicalRecord->id],
            $this->form->getState() + [
                'pet_id' => Pet::inRandomOrder()->first()->id
            ]
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
