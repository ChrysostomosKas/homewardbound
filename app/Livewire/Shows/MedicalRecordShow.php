<?php

namespace App\Livewire\Shows;

use App\Models\DoctorAppointment;
use App\Models\MedicalRecord;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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

class MedicalRecordShow extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public $medicalRecord;

    public function mount($medicalRecordId)
    {
        $this->medicalRecord = MedicalRecord::query()->with('pet')->where('id', '=', $medicalRecordId)->first();
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('Scheduled Appointments'))
            ->query(DoctorAppointment::query()->where('medical_record_id', '=', $this->medicalRecord->id))
            ->columns([
                TextColumn::make('appointment_date')->sortable()->label(__('Appointment Date')),
                TextColumn::make('reason')->sortable()->label(__('Reason')),
                TextColumn::make('contact_number')->searchable()->sortable()->label(__('Contact phone-number')),
                TextColumn::make('created_at')->sortable()->label(__('created_at')),
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
                    })
            ])->actions([
                ActionGroup::make([
                    EditAction::make()->label(__('Edit'))
                        ->form([
                            TextInput::make('contact_number')
                                ->label(__('Contact phone-number'))
                                ->columnSpan(1)
                                ->minLength(10)
                                ->maxLength(10)
                                ->nullable(),
                            DateTimePicker::make('appointment_time')
                                ->label(__('Appointment time'))
                                ->seconds(false)
                                ->required(),
                            Textarea::make('reason')
                                ->label(__('Reason'))
                                ->helperText('Προσθέστε τον λόγο επίσκεψης στον γιατρό.')
                                ->columnSpan(1)
                                ->rows(10)
                                ->cols(10)
                                ->nullable()
                        ])
                        ->using(function (DoctorAppointment $record, array $data): DoctorAppointment {
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
        return view('livewire.shows.medical-record-show');
    }
}
