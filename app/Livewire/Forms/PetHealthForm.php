<?php

namespace App\Livewire\Forms;

use App\Models\PetHealth;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class PetHealthForm extends Component implements HasForms
{
    use InteractsWithForms;

    public PetHealth $petHealth;
    public int $pet_id;
    public $bathed_at;
    public $hair_condition;
    public $last_vaccination;
    public $teeth_condition;

    public function mount($pet_id, $pet_health_id = null)
    {
         $this->pet_id = $pet_id;

        if ($pet_health_id) {
            $this->petHealth = PetHealth::find($pet_health_id);

            $this->form->fill([
                'bathed_at' => $this->petHealth->bathed_at,
                'hair_condition' => $this->petHealth->hair_condition,
                'last_vaccination' => $this->petHealth->last_vaccination,
                'teeth_condition' => $this->petHealth->teeth_condition
            ]);
        } else {
            $this->form->fill([
                'bathed_at' => '',
                'hair_condition' => '',
                'last_vaccination' => '',
                'teeth_condition' => ''
            ]);

            $this->petHealth = $this->makeBlankPetHealthForm();
        }
    }

    public function makeBlankPetHealthForm()
    {
        return PetHealth::make(['created_at' => now()]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make(__('Pet Health Information Form'))
                ->description(__('Please fill out the form to book an appointment for your pet.'))
                ->schema([
                    Grid::make(2)
                        ->schema([
                            DatePicker::make('bathed_at')
                                ->label(__('Bathed Αt'))
                                ->seconds(false)
                                ->nullable(),
                            DatePicker::make('last_vaccination')
                                ->label(__('Last Vaccination'))
                                ->seconds(false)
                                ->nullable()
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('hair_condition')
                                ->label(__('Hair Condition'))
                                ->nullable(),
                            TextInput::make('teeth_condition')
                                ->label(__('Teeth Condition'))
                                ->nullable(),
                        ]),
                ])
        ];
    }

    /**
     * @throws ValidationException
     */
    public function savePetHealthRecord()
    {
        $new_petHealthData = $this->form->getState() + [
                'pet_id' => $this->pet_id
            ];

        $new_petHealth = PetHealth::updateOrCreate(
            ['id' => $this->petHealth->id],
            $new_petHealthData
        );

        if ($new_petHealth->id) {
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
        return view('livewire.forms.pet-health-form');
    }
}
