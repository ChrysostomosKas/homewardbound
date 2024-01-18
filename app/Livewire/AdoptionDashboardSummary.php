<?php

namespace App\Livewire;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use App\Models\AdoptionInterest;
use Livewire\Component;

class AdoptionDashboardSummary extends Component
{
    public int $total_ads;
    public int $adoption_interests;
    public int $total_adoptions;
    public int $pets_for_adoption;

    public function mount()
    {
        $adoption_interests_collection = AdoptionInterest::query()
            ->where('status', '=', AdoptionAdStatus::Closed->name)
            ->orWhere('status', '=', AdoptionAdStatus::Open->name)
            ->get();

        $this->total_ads = AdoptionAd::all()->count();
        $this->adoption_interests = AdoptionInterest::where('status', '=', 'Open')->count();
        $this->total_adoptions = AdoptionInterest::where('status', '=', AdoptionAdStatus::Closed->name)->count();
        $this->pets_for_adoption = AdoptionAd::query()->whereNotIn('id', $adoption_interests_collection->pluck('id')->toArray())->get()->count();
    }
    public function render()
    {
        return view('livewire.adoption-dashboard-summary');
    }
}
