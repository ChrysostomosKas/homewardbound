<?php

namespace App\Livewire;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserLikedAdoptionAds extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        $user_adoption_ads_ids = DB::table('adoption_ad_user')->where('user_id', '=', auth()->id())->pluck('adoption_ad_id')->toArray();

        return $table
            ->query(AdoptionAd::query())
            ->heading(__('Your Liked Adoption Ads'))
            ->modifyQueryUsing(function ($query) use ($user_adoption_ads_ids) {
                return $query->whereIn('id', $user_adoption_ads_ids)
                    ->where('status', '=', AdoptionAdStatus::Open->name);
            })
            ->columns([
                TextColumn::make('title'),
            ]);
    }

    public function render()
    {
        return view('livewire.user-liked-adoption-ads');
    }
}
