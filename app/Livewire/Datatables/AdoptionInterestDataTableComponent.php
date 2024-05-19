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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class AdoptionInterestDataTableComponent extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function mount()
    {
            //
    }

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        $user = auth()->user();

        return $table
            ->heading(__('Adoption Interests Overview'))
            ->query(AdoptionInterest::query()
                                            ->when(in_array(2, $user->roles->pluck('id')->toArray()), function ($subQuery) use ($user) {
                                                $subQuery->where('user_id', '=', $user->id);
                                            }))
            ->columns([
                TextColumn::make('user.full_name')->sortable()->label(__('Full Name')),
                TextColumn::make('contact_phone_number')->searchable()->sortable()->label(__('Contact phone-number')),
                TextColumn::make('city')->searchable()->sortable()->label(__('City')),
                TextColumn::make('address')->searchable()->sortable()->label(__('Address')),
                TextColumn::make('contact_email')->searchable()->sortable()->label(__('Contact email')),
                TextColumn::make('status')->label(__('Status'))->badge()
                    ->color(fn (AdoptionAdStatus $state): string => match ($state) {
                        AdoptionAdStatus::Open => 'gray',
                        AdoptionAdStatus::Closed => 'success',
                        AdoptionAdStatus::Rejected => 'warning',
                    }),
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
                    EditAction::make()->label(__('Edit'))->visible(Gate::allows('admin'))
                        ->form([
                            Select::make('status')->label(__('Status'))
                                ->options([
                                    'Open' => 'Open',
                                    'Closed' => 'Closed',
                                    'Rejected' => 'Rejected'
                                ])
                                ->required(),
                            FileUpload::make('adoption_certificate')
                                ->label(__('Adoption Certificate'))
                                ->columnSpan(1)
                                ->nullable(),
                            Textarea::make('reason')
                                ->label(__('Reason'))
                                ->helperText(__('You should only add the reason to the request in case of cancellation.'))
                                ->columnSpan(1)
                                ->rows(10)
                                ->cols(10)
                                ->nullable()
                        ])
                        ->using(function (AdoptionInterest $record, array $data): AdoptionInterest {
                            $record->update($data);
                            if ($record->status == AdoptionAdStatus::Closed
                                || !is_null($record->adoption_certificate)
                                || ($record->status == AdoptionAdStatus::Rejected && !is_null($record->reason))
                            ){
                                activity()
                                    ->performedOn($record)
                                    ->causedBy(Auth::user())
                                    ->setEvent('created')
                                    ->withProperties([
                                        'name' => $record->status->name(),
                                        'color' => $record->status->color(),
                                        'svg' => 'email'
                                    ])
                                    ->log('An informational email has been sent to your email address');

                                if (!is_null($record->adoption_certificate)) {
                                    activity()
                                        ->performedOn($record)
                                        ->causedBy(Auth::user())
                                        ->setEvent('created')
                                        ->withProperties([
                                            'name' => $record->status->name(),
                                            'color' => $record->status->color(),
                                            'svg' => 'file'
                                        ])
                                        ->log('The adoption certificate has been sent');
                                }

                                dispatch(new SendAdoptionInterestStatusChangeEmailJob($record->user, $record));
                            }
                            activity()
                                ->performedOn($record)
                                ->causedBy(Auth::user())
                                ->setEvent('updated')
                                ->withProperties([
                                    'name' => AdoptionAdStatus::Closed->name(),
                                    'color' => AdoptionAdStatus::Rejected->color(),
                                    'svg' => 'trash'
                                ])
                                ->log('Your request status has changed');

                            return $record;
                        })
                        ->after(function () {
                            $this->dispatch('notification', [
                                'success' => true,
                                'message' => __('Your changes have been successfully saved!'),
                                'delay' => 5000
                            ]);
                        }),
                    DeleteAction::make()->label(__('Delete'))->after(function (AdoptionInterest $record){
                        activity()
                            ->performedOn($record)
                            ->causedBy(Auth::user())
                            ->setEvent('deleted')
                            ->withProperties([
                                'name' => AdoptionAdStatus::Closed->name(),
                                'color' => AdoptionAdStatus::Rejected->color(),
                                'svg' => 'trash'
                            ])
                            ->log('The request created successfully');
                    }),
                ])->tooltip('Actions')
            ]);
    }

    public function render()
    {
        return view('livewire.datatables.adoption-interest-data-table-component');
    }
}
