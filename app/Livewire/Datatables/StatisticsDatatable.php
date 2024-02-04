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

    private $dateAssociations;

    public function __construct()
    {
        $this->dateAssociations = [
            '1' => __("January"),
            '2' => __("February"),
            '3' => __("March"),
            '4' => __("April"),
            '5' => __("May"),
            '6' => __("June"),
            '7' => __("July"),
            '8' => __("August"),
            '9' => __("September"),
            '10' => __("October"),
            '11' => __("November"),
            '12' => __("December"),
        ];
    }

    private const CLASS_ASSOCIATIONS = [
        'Users' => User::class,
        'AdoptionInterests' => AdoptionInterest::class,
        'AdoptionAds' => AdoptionAd::class
    ];

    public function mount()
    {
        //
    }

    public function render()
    {

        $lineChartModel = (new LineChartModel())
            ->setTitle(__('Statistics'))
            ->multiLine()
            ->setColors(['#66DA26', '#f6ad55', '#90cdf4', '#fc8181'])
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
                    $lineChartModel->addSeriesPoint($key, $this->dateAssociations[$i], $value->filter(function ($value) use ($current_year, $i) {
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
