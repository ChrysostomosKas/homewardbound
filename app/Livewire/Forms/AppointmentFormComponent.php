<?php

namespace App\Livewire\Forms;

use App\Models\Appointment;
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

    public Appointment $appointment;
    public string $contact_number;
    public string $appointment_time;
    public string $reason;
    public int $pet_id;

    public function mount($appointment_id = null, $pet_id = null): void
    {
        $this->pet_id = $pet_id;

        if ($appointment_id) {
            $this->appointment = Appointment::find($appointment_id);

            $this->form->fill([
                'contact_number' => $this->appointment->contact_number,
                'appointment_time' => $this->appointment->appointment_time,
                'reason' => $this->appointment->appointment_time
            ]);
        } else {
            $this->form->fill([
                'contact_number' => '',
                'appointment_time' => '',
                'reason' => ''
            ]);

            $this->appointment = $this->makeBlankAppointmentForm();
        }
    }

    public function makeBlankAppointmentForm()
    {
        return Appointment::make(['created_at' => now()]);
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
                            DateTimePicker::make('appointment_time')
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
                ])
        ];
    }

    /**
     * @throws ValidationException
     */
    public function saveAppointment()
    {
        $new_appointment = Appointment::updateOrCreate(
            ['id' => $this->appointment->id],
            $this->form->getState() + [
                'pet_id' => $this->pet_id
            ]
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

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.forms.appointment-form-component');
    }
}
