<?php

namespace App\Livewire\Datatables;

use App\Enums\AdoptionAdStatus;
use App\Jobs\SendAdoptionInterestStatusChangeEmailJob;
use App\Models\AdoptionInterest;
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

class AdoptionInterestDataTableComponent extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function mount()
    {
        dd();
        //
    }

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        $user = auth()->user();

        return $table
            ->heading('Adoption Interests Overview')
            ->query(AdoptionInterest::query()
                                            ->when(in_array(2, $user->roles->pluck('id')->toArray()), function ($subQuery) use ($user) {
                                                $subQuery->where('user_id', '=', $user->id);
                                            }))
            ->columns([
                TextColumn::make('user.full_name')->sortable(),
                TextColumn::make('contact_phone_number')->searchable()->sortable(),
                TextColumn::make('city')->searchable()->sortable(),
                TextColumn::make('zip_code')->sortable(),
                TextColumn::make('contact_email')->searchable()->sortable(),
                TextColumn::make('status'),
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
                    EditAction::make()
                        ->form([
                            Select::make('status')
                                ->options([
                                    'Open' => 'Open',
                                    'Closed' => 'Closed',
                                    'Rejected' => 'Rejected'
                                ])
                                ->required(),
                            FileUpload::make('adoption_certificate')
                                ->label('Adoption Certificate')
                                ->columnSpan(1)
                                ->nullable(),
                            Textarea::make('reason')
                                ->label('Reason')
                                ->helperText('Προσθέστε τον λόγο στην αίτηση μόνο σε περίπτωση ακύρωσης.')
                                ->columnSpan(1)
                                ->rows(10)
                                ->cols(10)
                                ->nullable()
                        ])
                        ->using(function (AdoptionInterest $record, array $data): AdoptionInterest {
                            $record->update($data);
                            if ($record->status == AdoptionAdStatus::Closed->name
                                || !is_null($record->adoption_certificate)
                                || ($record->status == AdoptionAdStatus::Rejected->name && !is_null($record->reason))
                            ){
                                dispatch(new SendAdoptionInterestStatusChangeEmailJob($record->user, $record));
                            }
                            return $record;
                        })
                        ->after(function () {
                            $this->dispatch('notification', [
                                'success' => true,
                                'message' => __('Your changes have been successfully saved!'),
                                'delay' => 5000
                            ]);
                        }),
                    DeleteAction::make(),
                ])->tooltip('Actions')
            ]);
    }

    public function render()
    {
        return view('livewire.datatables.adoption-interest-data-table-component');
    }
}
