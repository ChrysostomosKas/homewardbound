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

    public function percentageDifference(): array
    {
        if ($this->total_ads > 0) {
            $percentage = (($this->adoption_interests + $this->total_adoptions + $this->pets_for_adoption) / $this->total_ads) * 100;
            $formattedPercentage = number_format($percentage, 2);

            if ($percentage > 1) {
                return ['text' => '+' . $formattedPercentage . '%', 'color' => 'green'];
            } elseif ($percentage < 0) {
                return ['text' => $formattedPercentage . '%', 'color' => 'red'];
            } else {
                return ['text' => '+' . $formattedPercentage . '%', 'color' => 'gray'];
            }
        }

        return ['text' => '+0%', 'color' => 'text-gray-500'];
    }
    public function render()
    {
        return view('livewire.adoption-dashboard-summary', [
            'percentageDifference' => $this->percentageDifference()
        ]);
    }
}
