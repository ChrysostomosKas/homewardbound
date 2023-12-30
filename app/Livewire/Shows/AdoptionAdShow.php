<?php

namespace App\Livewire\Shows;

use App\Models\AdoptionAd;
use Livewire\Component;

class AdoptionAdShow extends Component
{
    public AdoptionAd $adoptionAd;

    public function render()
    {
        return view('livewire.shows.adoption-ad-show');
    }
}
