<?php

namespace App\Livewire\Datatables;

use App\Models\MedicalRecord;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class MedicalRecordDatatable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->heading('Medical Records Overview')
            ->query(MedicalRecord::query()->with('pet'))
            ->columns([
                TextColumn::make('pet.name')->sortable(),
                TextColumn::make('spaying_neutering_date'),
                TextColumn::make('created_at')->searchable()->sortable(),
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
                    })
            ])->actions([
                ActionGroup::make([
                    DeleteAction::make(),
                ])->tooltip('Actions')
            ]);
    }

    /**
     *
     */
    public function createMedicalRecord()
    {
        return Redirect::route('medical-records.create');
    }

    public function render()
    {
        return view('livewire.datatables.medical-record-datatable');
    }
}
