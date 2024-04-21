<?php

namespace App\Livewire\Forms;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class BreedForm extends Component implements HasForms
{
    use InteractsWithForms;

    public $breed_category;
    public $modelClass;
    public $name_en = '';
    public $name_gr = '';

    public function mount($breed_category = null)
    {
        $this->breed_category = $breed_category;
        $this->modelClass = 'App\\Models\\' . $this->breed_category . 'Breed';

        $this->form->fill([
            'name_en' => '',
            'name_gr' => '',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make(__('Breed information'))
                ->description(__('Provide some information about the breed.'))
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name_en')
                                ->label(__('name_en'))
                                ->columnSpan(1)
                                ->required(),
                            TextInput::make('name_gr')
                                ->label(__('name_gr'))
                                ->columnSpan(1)
                                ->required(),
                        ]),
                ]),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function saveBreedRecord()
    {
        $breedData = $this->form->getState();
        $new_breed = new $this->modelClass();
        $new_breed->name_en = $breedData['name_en'];
        $new_breed->name_gr = $breedData['name_gr'];
        $new_breed->save();

        if ($new_breed->id) {
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

        return Redirect::route('breeds.index');
    }

    public function render()
    {
        return view('livewire.forms.breed-form');
    }
}
