<?php

namespace App\Livewire;

use App\Enums\AdoptionAdStatus;
use App\Models\AdoptionInterest;
use App\Models\User;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class DashboardChartPanel extends Component
{
    public function render()
    {
        if (Gate::denies('admin')) {
            abort('403', "Access to this resource is forbidden.");
        }

        $lineChartModel = (new LineChartModel())
            ->setTitle(__('Weekly Stats'))
            ->multiLine()
            ->setSmoothCurve();

        $view = [
            'lineChartModel' => $lineChartModel
        ];

        $users = User::all();
        $requests = AdoptionInterest::where('adoption_interests.status', '=', AdoptionAdStatus::Open->name);

        for ($i = 6; $i >= 0; $i--) {
            $subDays = now()->subDays($i);
            $formatted_date = $subDays->format('Y-m-d');
            $lineChartModel->addSeriesPoint(__('Users'), $subDays->format('d/m/Y'), $users->whereBetween('created_at', [$formatted_date . " 00:00:00", $formatted_date . " 23:59:59"])->count());
            $lineChartModel->addSeriesPoint(__('Requests'), $subDays->format('d/m/Y'), $requests->whereBetween('created_at', [$formatted_date . " 00:00:00", $formatted_date . " 23:59:59"])->count());
        }

        return view('livewire.dashboard-chart-panel', $view);
    }
}
