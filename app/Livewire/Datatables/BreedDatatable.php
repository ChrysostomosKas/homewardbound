<?php

namespace App\Livewire\Datatables;

use App\Models\AmphibianBreed;
use App\Models\BirdBreed;
use App\Models\CatBreed;
use App\Models\DogBreed;
use App\Models\FishBreed;
use App\Models\HamsterBreed;
use App\Models\HorseBreed;
use App\Models\RabbitBreed;
use App\Models\ReptileBreed;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;

class BreedDatatable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public string $breed_type = '';

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        $modelClass = 'App\\Models\\' . $this->breed_type . 'Breed';

        return $table
            ->query($modelClass::query())
            ->columns([
                TextColumn::make('name_gr')->searchable()->sortable()->label('name_gr'),
                TextColumn::make('name_en')->searchable()->sortable()->label('name_en'),
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
            ])->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->form([
                            TextInput::make('name_en')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('name_gr')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->using(function (DogBreed|CatBreed|BirdBreed|FishBreed|RabbitBreed|HamsterBreed|ReptileBreed|AmphibianBreed|HorseBreed $record, array $data): DogBreed|CatBreed|BirdBreed|FishBreed|RabbitBreed|HamsterBreed|ReptileBreed|AmphibianBreed|HorseBreed {
                            $record->update($data);

                            return $record;
                        })
                        ->after(function () {
                            $this->dispatch('notification', [
                                'success' => true,
                                'message' => __('Your changes have been successfully saved!'),
                                'delay' => 5000
                            ]);
                        }),
                    DeleteAction::make()->label(__('Delete')),
                ])->tooltip('Actions')
            ]);
    }

    /**
     *
     */
    public function createBreedRecord()
    {
        return Redirect::route('breedCategory.create', $this->breed_type);
    }

    public function render()
    {
        return view('livewire.datatables.breed-datatable');
    }
}
