<?php

namespace App\Livewire\Datatables;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserDatatable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->with('roles'))
            ->columns([
                TextColumn::make('first_name')->searchable()->sortable(),
                TextColumn::make('last_name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('city')->sortable(),
                TextColumn::make('phone')->sortable(),
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
                Filter::make('city')
                    ->form([
                        TextInput::make('city'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['city'],
                                fn(Builder $query, $city): Builder => $query->where('city', 'LIKE', "%".$city."%"),
                            );
                    }),
            ])->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->form([
                            TextInput::make('first_name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('last_name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->required()
                                ->email(),
                            Select::make('role')
                                ->options($this->getRolesProperty())
                                ->required(),
                        ])
                        ->using(function (User $record, array $data): User {
                            $record->update($data);
                            if ($data['role']) {
                                $record->syncRoles($data['role']);
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

    public function getRolesProperty()
    {
        return Cache::remember('roles.all', 60 * 60, function(){
            return Role::get()->pluck('name','id')->toArray();
        });
    }

    public function render()
    {
        return view('livewire.datatables.user-datatable');
    }
}
