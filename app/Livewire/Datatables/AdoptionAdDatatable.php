<?php

namespace App\Livewire\Datatables;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use Livewire\Component;

class AdoptionAdDatatable extends Component
{
    public function getAdoptionAdsProperty()
    {
        return AdoptionAd::query()
            ->where('status', '=', AdoptionAdStatus::Open->name)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.datatables.adoption-ad-datatable', [
            'adoptionAds' => $this->adoptionAds
        ]);
    }
}
