<?php

namespace App\Livewire;

use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class HealthRecordViewer extends Component
{
    public $medicalRecords;

    public function mount()
    {
        $this->medicalRecords = MedicalRecord::with('pet.user')->whereHas('pet.user', function ($query) {
            $query->where('id', auth()->id());
        })->get();
    }

    public function createMedicalRecord()
    {
        return Redirect::route('medical-records.create');
    }

    public function render()
    {
        return view('livewire.health-record-viewer');
    }
}
