<?php

namespace App\Livewire\Datatables;

use Livewire\Component;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class AnalyticsDatatable extends Component
{
    public $topBrowsersData;
    public $mostVisitedPagesData;
    public $topCountriesData;

    public function mount() {
        $this->topBrowsersData = Analytics::fetchTopBrowsers(Period::days(7));
        $this->topCountriesData = Analytics::fetchTopCountries(Period::days(7));
        $this->mostVisitedPagesData = Analytics::fetchMostVisitedPages(Period::days(7));

        $this->mostVisitedPagesData = $this->mostVisitedPagesData->map(function ($pageTitle) {
            $pageTitle['fullPageUrl'] = ucwords(str_replace('homewardbound.test/', '', $pageTitle['fullPageUrl']));
            if ($pageTitle['fullPageUrl'] == '') {
                $pageTitle['fullPageUrl'] = 'Dashboard';
            }
            return $pageTitle;
        });
        }

    public function render()
    {
        return view('livewire.datatables.analytics-datatable');
    }
}
