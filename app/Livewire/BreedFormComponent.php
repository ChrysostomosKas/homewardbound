<?php

namespace App\Livewire;

use App\Enums\PetCategory;
use App\Models\AmphibianBreed;
use App\Models\BirdBreed;
use App\Models\CatBreed;
use App\Models\DogBreed;
use App\Models\FishBreed;
use App\Models\HamsterBreed;
use App\Models\HorseBreed;
use App\Models\RabbitBreed;
use App\Models\ReptileBreed;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class BreedFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public string $name_en = '';
    public string $name_gr = '';
    public string $breed_type = '';
    public string $message = '';
    public string $slug = '';
    public DogBreed|CatBreed|BirdBreed|FishBreed|RabbitBreed|HamsterBreed|ReptileBreed|AmphibianBreed|HorseBreed $breed;

    protected function rules()
    {
        return [
            'name_en' => 'required | string | max:255',
            'name_gr' => 'required | string | max:255',
        ];
    }

    public function mount($slug = null): void
    {
        if ($this->slug) {
            $modelClass = 'App\\Models\\' . $this->breed_type.'Breed';

            $this->breed = $modelClass::query()
                ->where('slug', $slug)
                ->first();

            $this->form->fill([
                'name_en' => $this->breed->name_en,
                'name_gr' => $this->breed->name_gr,
                'breed_type' => class_basename($this->breed )
            ]);
        } else {
            $this->form->fill([
                'name_en' => $this->name_en,
                'name_gr' => $this->name_gr,
            ]);
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Breed Details')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('breed_type')
                                ->label('Breed Type')
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
                            TextInput::make('name_en')
                                ->label('Breed Name (English)')
                                ->columnSpan(1)
                                ->required(),
                            TextInput::make('name_gr')
                                ->label('Breed Name (Greek)')
                                ->columnSpan(1)
                                ->required()
                        ]),
                ])
        ];
    }

    /**
     * @throws ValidationException
     */
    public function saveBreed()
    {
        $this->validate();

        if (!isset($this->breed->id)) {
            $modelClass = 'App\\Models\\' . $this->breed_type;
            $this->breed = new $modelClass();
        }

        $this->breed->name_en = $this->name_en;
        $this->breed->name_gr = $this->name_gr;

        $this->breed->save();

        if ($this->breed->id) {
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
        return view('livewire.breed-form-component');
    }
}
