<?php

namespace App\Livewire;

use App\Models\MapMarker;
use Livewire\Component;

class PetReportMapComponent extends Component
{
    public function render()
    {
        $markers = MapMarker::all();

        return view('livewire.pet-report-map-component', [
            'markers' => $markers
        ]);
    }
}
