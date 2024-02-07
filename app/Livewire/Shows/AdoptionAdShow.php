<?php

namespace App\Livewire\Shows;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use App\Models\AdoptionInterest;
use Livewire\Component;

class AdoptionAdShow extends Component
{
    public AdoptionAd $adoptionAd;
    public bool $interested = false;

    public function mount()
    {
        $this->interested = AdoptionInterest::query()
                                                ->where('user_id', '=', auth()->id())
                                                ->where('adoption_ad_id', '=', $this->adoptionAd->id)
                                                ->where('status', '=', AdoptionAdStatus::Open->name)
                                                ->exists();
    }

    public function render()
    {
        return view('livewire.shows.adoption-ad-show');
    }
}
