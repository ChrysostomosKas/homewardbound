<?php

namespace App\Livewire\Datatables;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use Livewire\Component;

class AdoptionAdDatatable extends Component
{

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
        return AdoptionAd::query()
            ->where('status', '=', AdoptionAdStatus::Open->name)
            ->when($this->filters['Dog'], fn($query) => $query->orWhere('type_of_pet', '=', 'Dog'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Cat'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Bird'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Fish'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Rabbit'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Hamster'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Reptile'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Amphibian'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Horse'))
            ->when($this->filters['Cat'], fn($query) => $query->orWhere('type_of_pet', '=', 'Horse'))
            ->when($this->filters['Other'], fn($query) => $query->orWhere('type_of_pet', '=', 'Horse'))
            ->when($this->filters['Other'], fn($query) => $query->orWhere('type_of_pet', '=', 'Horse'))
            ->when($this->filters['SortByDesc'], fn($query) => $query->orderBy('created_at', 'desc'))
            ->when($this->filters['SortByAsc'], fn($query) => $query->orderBy('created_at', 'asc'))
            ->paginate(10);
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
