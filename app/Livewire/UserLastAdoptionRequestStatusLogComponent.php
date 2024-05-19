<?php

namespace App\Livewire;

use App\Models\AdoptionInterest;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class UserLastAdoptionRequestStatusLogComponent extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
{
    $lastAdoptionRequest = AdoptionInterest::query()->where('adoption_interests.user_id', '=', auth()->id())
        ->orderByDesc('adoption_interests.created_at')
        ->get()
        ->last();

    return $table
        ->query(Activity::query()->with('subject', 'causer'))
        ->columns([
            TextColumn::make('description')->label(__('Description')),
            TextColumn::make('causer.full_name')->label(__('Action By')),
            TextColumn::make('created_at')->label(__('Date')),
        ])->filters([
            Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from')->label(__('created_from')),
                    DatePicker::make('created_until')->label(__('created_until')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                }),
        ]);
}

    public function render()
    {
        return view('livewire.user-last-adoption-request-status-log-component');
    }
}
