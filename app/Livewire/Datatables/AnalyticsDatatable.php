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
            $url = parse_url($pageTitle['fullPageUrl']);
            $path = trim($url['path'], '/');
            $segments = explode('/', $path);
            $basicPage = count($segments) >= 2 ? $segments[1] : 'Dashboard';

            if (empty($basicPage)) {
                $basicPage = 'Dashboard';
            }

            return [
                'basicPage' => ucwords($basicPage),
                'screenPageViews' => $pageTitle['screenPageViews']
            ];
        })->reduce(function ($carry, $item) {
            $basicPage = $item['basicPage'];
            $screenPageViews = $item['screenPageViews'];

            if (!isset($carry[$basicPage])) {
                $carry[$basicPage] = 0;
            }

            $carry[$basicPage] += $screenPageViews;

            return $carry;
        }, []);
    }

    public function render()
    {
        return view('livewire.datatables.analytics-datatable');
    }
}
