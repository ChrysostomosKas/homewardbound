<?php

namespace App\Livewire\Datatables;

use App\Enums\PetCategory;
use Livewire\Component;

class SelectionBreedComponent extends Component
{
    public string $breed_type = '';
    public $petCategories;

    public function mount(): void
    {
        $this->petCategories = [];

        foreach (PetCategory::all() as $category) {
            $this->petCategories[] = [
                'name' => $category->name,
                'icon' => $category->icon()
            ];
        }
    }

    public function selectCategory($categoryName): void
    {
        $this->breed_type = $categoryName;
    }

    public function render()
    {
        return view('livewire.datatables.selection-breed-component');
    }
}
