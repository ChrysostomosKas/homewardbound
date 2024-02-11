<?php

namespace App\Livewire\Datatables;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionAd;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
use Livewire\Component;

class AdminAdoptionAdDatatable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->heading(__('Adoption Ads Overview'))
            ->query(AdoptionAd::query())
            ->columns([
                TextColumn::make('title')->searchable()->label(__('Title')),
                TextColumn::make('status')->sortable()->searchable()->label(__('Status')),
                TextColumn::make('location')->sortable()->searchable()->label(__('Location')),
                TextColumn::make('contact_phone_number')->searchable()->label(__('Contact phone-number')),
                TextColumn::make('contact_email')->searchable()->label(__('Contact email')),
            ])->filters([
                Filter::make('created_at')->label(__('created_at'))
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
                    })
            ])->actions([
                ActionGroup::make([
                    EditAction::make()->label(__('Edit'))
                        ->form([
                            Select::make('status')->label(__('Status'))
                                ->options([
                                    'Open' => 'Open',
                                    'Closed' => 'Closed'
                                ])
                                ->required(),
                        ])
                        ->using(function (AdoptionAd $record, array $data): AdoptionAd {
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

    public function render()
    {
        return view('livewire.datatables.admin-adoption-ad-datatable');
    }
}
