<?php

namespace App\Livewire;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use App\Models\AdoptionInterest;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserAdoptionInterests extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(AdoptionInterest::query()->with('adoptionAd')->where('user_id', '=', auth()->id()))
            ->heading(__('Your applications of Adoption Interests'))
            ->columns([
                TextColumn::make('adoptionAd.title')->label(__('Adoption ad')),
                TextColumn::make('status')->label(__('Status'))->badge()
                    ->color(fn (AdoptionAdStatus $state): string => match ($state) {
                        AdoptionAdStatus::Open => 'gray',
                        AdoptionAdStatus::Closed => 'success',
                        AdoptionAdStatus::Rejected => 'warning',
                    }),
                TextColumn::make('created_at')->label(__('created_at')),
            ]);
    }

    public function render()
    {
        return view('livewire.user-adoption-interests');
    }
}
