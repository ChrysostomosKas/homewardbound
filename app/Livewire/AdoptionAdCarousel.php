<?php

namespace App\Livewire;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use Livewire\Component;

class AdoptionAdCarousel extends Component
{
    public $adoptionAds;
    public AdoptionAd $adoptionAd;

    public function mount()
    {
        $this->adoptionAds = AdoptionAd::query()
            ->where('status', '=', AdoptionAdStatus::Open->name)
            ->whereNotIn('user_id', [auth()->id(), $this->adoptionAd->user_id])
            ->orderBy('created_at', 'desc')
            ->get()
            ->take(5);
    }

    public function render()
    {
        return view('livewire.adoption-ad-carousel');
    }
}
