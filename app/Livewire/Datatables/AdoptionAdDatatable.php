<?php

namespace App\Livewire\Datatables;

use App\Enums\AdoptionAdStatus;
use App\Enums\PetCategory;
use App\Models\AdoptionAd;
use Livewire\Component;
use Livewire\WithPagination;

class AdoptionAdDatatable extends Component
{
    use WithPagination;

    public $filters = [
        'Dog'       => false,
        'Cat'       => false,
        'Bird'      => false,
        'Fish'      => false,
        'Rabbit'    => false,
        'Hamster'   => false,
        'Reptile'   => false,
        'Amphibian' => false,
        'Horse'     => false,
        'Other'     => false,
        'SortByDesc' => false,
        'SortByAsc' => false,
    ];

    public function mount()
    {
        //
    }

    public function getAdoptionAdsProperty()
    {
        $query = AdoptionAd::query();

        foreach (PetCategory::all() as $petType) {
            $filterKey = $petType->name;
            if ($this->filters[$filterKey]) {
                $query->orWhere('type_of_pet', '=', $petType->name);
            }
        }

        if ($this->filters['Other']) {
            $otherPets = array_diff(array_map(fn($pet) => $pet->name(), PetCategory::all()), ['Άλλο']);
            $query->orWhereNotIn('type_of_pet', $otherPets);
        }

        if ($this->filters['SortByDesc']) {
            $query->orderBy('created_at', 'desc');
        } elseif ($this->filters['SortByAsc']) {
            $query->orderBy('created_at', 'asc');
        }

        return $query->where('status', '=', AdoptionAdStatus::Open->name)->paginate(10);
    }

    public function toggleLike($adoptionAdId)
    {
        $user = auth()->user();

        $user->likes()->where('adoption_ad_id', $adoptionAdId)->exists() ?
            $user->likes()->detach($adoptionAdId)
            : $user->likes()->attach($adoptionAdId);
    }

    public function hasLike($adoptionAdId)
    {
        return auth()->user()->likes()->where('adoption_ad_id', $adoptionAdId)->exists();
    }

    public function render()
    {
        return view('livewire.datatables.adoption-ad-datatable');
    }
}
