<?php

namespace App\Livewire\Forms;

use App\Models\DoctorAppointment;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class AppointmentFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public DoctorAppointment $appointment;
    public string $contact_number;
    public string $appointment_date;
    public string $reason;
    public string $diagnosis;
    public string $prescription;
    public int $medical_record_id;

    public function mount($appointment_id = null, $medical_record_id = null): void
    {
        $this->medical_record_id = $medical_record_id;

        if ($appointment_id) {
            $this->appointment = DoctorAppointment::find($appointment_id);

            $this->form->fill([
                'contact_number' => $this->appointment->contact_number,
                'appointment_date' => $this->appointment->appointment_date,
                'reason' => $this->appointment->appointment_time,
                'diagnosis' => $this->appointment->diagnosis,
                'prescription' => $this->appointment->prescription
            ]);
        } else {
            $this->form->fill([
                'contact_number' => '',
                'appointment_date' => '',
                'reason' => '',
                'diagnosis' => '',
                'prescription' => ''
            ]);

            $this->appointment = $this->makeBlankAppointmentForm();
        }
    }

    public function makeBlankAppointmentForm()
    {
        return DoctorAppointment::make(['created_at' => now()]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make(__('Schedule an Appointment'))
                ->description(__('Please fill out the form to book an appointment for your pet.'))
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('contact_number')
                                ->label(__('Contact phone-number'))
                                ->columnSpan(1)
                                ->minLength(10)
                                ->maxLength(10)
                                ->nullable(),
                            DateTimePicker::make('appointment_date')
                                ->label(__('Appointment date'))
                                ->seconds(false)
                                ->required()
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('reason')
                                ->label(__('Reason'))
                                ->helperText(__('Add the reason for visiting the doctor.'))
                                ->columnSpan(1)
                                ->rows(10)
                                ->cols(10)
                                ->nullable(),
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('diagnosis')
                                ->label(__('Diagnosis'))
                                ->columnSpan(1)
                                ->rows(10)
                                ->cols(10)
                                ->nullable(),
                        ]),
                    Grid::make(1)
                        ->schema([
                            Textarea::make('prescription')
                                ->label(__('Prescription'))
                                ->columnSpan(1)
                                ->rows(10)
                                ->cols(10)
                                ->nullable(),
                        ]),
                ])
        ];
    }

    /**
     * @throws ValidationException
     */
    public function saveAppointment()
    {
        $new_appointmentData = $this->form->getState() + [
                'medical_record_id' => $this->medical_record_id
            ];

        $new_appointment = DoctorAppointment::updateOrCreate(
            ['id' => $this->appointment->id],
            $new_appointmentData
        );

        if ($new_appointment->id) {
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

        return redirect()->route('medical-records.index');
    }

    public function render()
    {
        return view('livewire.forms.appointment-form-component');
    }
}
