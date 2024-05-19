<?php

namespace App\Livewire\Datatables;

use App\Enums\ReportRequestStatus;
use App\Models\MapMarker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class PinRequestsDatatable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public string $breed_type = '';

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(MapMarker::query())
            ->columns([
                TextColumn::make('contact_phone_number')->searchable()->sortable()->label('Contact phone-number'),
                TextColumn::make('status')->label(__('Status'))->badge()
                    ->color(fn (ReportRequestStatus $state): string => match ($state) {
                        ReportRequestStatus::Open => 'warning',
                        ReportRequestStatus::Closed => 'success',
                        ReportRequestStatus::Processing => 'warning',
                        ReportRequestStatus::Rejected => 'rejected',
                    }),
                TextColumn::make('created_at')->searchable()->sortable()->label('created_at'),
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
                            Select::make('status')->label(__('Status'))
                                ->options([
                                    'Open' => 'Open',
                                    'Closed' => 'Closed',
                                    'Processing' => 'Processing',
                                    'Rejected' => 'Rejected',
                                ])
                                ->required(),
                        ])
                        ->using(function (MapMarker $record, array $data): MapMarker {
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
    public function createPinRequestRecord()
    {
        return Redirect::route('breedCategory.create', $this->breed_type);
    }

    public function render()
    {
        return view('livewire.datatables.pin-requests-datatable');
    }
}
