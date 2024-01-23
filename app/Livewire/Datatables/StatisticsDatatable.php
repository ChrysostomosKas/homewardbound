<?php

namespace App\Livewire\Datatables;

use App\Models\AdoptionAd;
use App\Models\AdoptionInterest;
use App\Models\User;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Livewire\Component;

class StatisticsDatatable extends Component
{
    public string $time_range = 'week';
    public string $message = '';

    private const CLASS_ASSOCIATIONS = [
        'Users' => User::class,
        'AdoptionInterests' => AdoptionInterest::class,
        'AdoptionAds' => AdoptionAd::class
    ];

    private const DATE_ASSOCIATIONS = [
        '1' => 'Ιανουάριος',
        '2' => 'Φεβρουάριος',
        '3' => 'Μάρτιος',
        '4' => 'Απρίλιος',
        '5' => 'Μάιος',
        '6' => 'Ιούνιος',
        '7' => 'Ιούλιος',
        '8' => 'Αύγουστος',
        '9' => 'Σεπτέμβριος',
        '10' => 'Οκτώβριος',
        '11' => 'Νοέμβριος',
        '12' => 'Δεκέμβριος',
    ];

    public function mount()
    {
        if ($this->time_range != 'week') {
            dd($this->time_range);
        }
    }

    public function render()
    {

        $lineChartModel = (new LineChartModel())
            ->setTitle('Statistics')
            ->multiLine()
//            ->setColors(['#66DA26', '#f6ad55', '#90cdf4', '#fc8181'])
            ->setSmoothCurve();

        $current_year = date("Y");

        if ($this->time_range == 'week' || is_null($this->time_range)) {
            foreach (self::CLASS_ASSOCIATIONS as $key => $value) {
                for ($i = 6; $i >= 0; $i--) {
                    $subDays = now()->subDays($i);
                    $lineChartModel->addSeriesPoint($key, $subDays->format('d.m.Y'), $value::whereDate('created_at', $subDays->format('Y-m-d'))->count());
                }
            }
        } elseif ($this->time_range == 'month') {
            foreach (self::CLASS_ASSOCIATIONS as $key => $value) {
                for ($i = now()->month()->daysInMonth; $i >= 0; $i--) {
                    $subDays = now()->subDays($i);
                    $formatted_date = $subDays->format('Y-m-d');
                    $lineChartModel->addSeriesPoint($key, $subDays->format('d.m.Y'), $value::whereBetween('created_at', [$formatted_date . " 00:00:00", $formatted_date . " 23:59:59"])->count());
                }
            }
        } elseif ($this->time_range == 'year') {
            foreach (self::CLASS_ASSOCIATIONS as $key => $value) {
                $value = $value::all();

                for ($i = 12; $i >= 1; $i--) {
                    $lineChartModel->addSeriesPoint($key, self::DATE_ASSOCIATIONS[$i], $value->filter(function ($value) use ($current_year, $i) {
                        return $value->created_at->year == $current_year && $value->created_at->month == $i;
                    })->count());
                }
            }

        }

        return view('livewire.datatables.statistics-datatable', [
            'lineChartModel' => $lineChartModel
        ]);
    }
}
