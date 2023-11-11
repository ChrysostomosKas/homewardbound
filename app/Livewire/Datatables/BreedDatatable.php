<?php

namespace App\Livewire\Datatables;

use App\Models\DogBreed;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Notifications\Notification;

class BreedDatatable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(DogBreed::query())
            ->columns([
                TextColumn::make('name_gr')->searchable(),
                TextColumn::make('name_en')->searchable(),
            ])->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
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
                    ViewAction::make()->form([
                        TextInput::make('name_en')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('name_gr')
                            ->required()
                            ->maxLength(255),
                    ]),
                    EditAction::make()
                        ->form([
                            TextInput::make('name_en')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('name_gr')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Breed updated')
                                ->body('The breed has been saved successfully.'),
                        ),
                    DeleteAction::make(),
                ])->tooltip('Actions')
            ]);
    }

    public function render()
    {
        return view('livewire.datatables.breed-datatable');
    }
}
