<?php

namespace App\Livewire\Datatables;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use Livewire\Component;

class AdoptionAdDatatable extends Component
{

    public function mount()
    {
        //
    }

    public function getAdoptionAdsProperty()
    {
        return AdoptionAd::query()
            ->where('status', '=', AdoptionAdStatus::Open->name)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function toggleLike($adoptionAdId)
    {
        $user = auth()->user();

        $user->likes()->where('adoption_ad_id', $adoptionAdId)->exists() ?
            $user->likes()->detach($adoptionAdId)
            : $user->likes()->attach($adoptionAdId);
    }

    public function render()
    {
        return view('livewire.datatables.adoption-ad-datatable', [
            'adoptionAds' => $this->adoptionAds,
            'hasLiked' => function ($adId) {
                $user = auth()->user();

                if ($user) {
                    return $user->likes()->where('adoption_ad_id', $adId)->exists();
                }

                return false;
            }
        ]);
    }
}
