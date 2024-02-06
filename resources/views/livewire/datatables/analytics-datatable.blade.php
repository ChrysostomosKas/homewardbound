<div>
    <div class="mx-auto max-w-2xl lg:text-center">
        <h2 class="text-2xl font-semibold leading-7 text-indigo-600">{{ __('Analytics Dashboard') }}</h2>
        <p class="mt-6 text-lg leading-8 text-gray-600">{{ __('Explore the latest insights and trends with our Analytics Dashboard.') }}</p>
    </div>

    <div class="m-10 grid gap-5 sm:grid-cols-3  mx-auto max-w-screen-lg">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-4">
                <h2 class="px-3 py-3 text-lg font-medium text-gray-900 border-b border-gray-200">{{ __('Top Browsers') }}</h2>
                <div class="mt-6 flow-root overflow-auto min-h-[150px] max-h-[150px]">
                    <ul role="list" class="-my-4 divide-y divide-gray-200">
                        @forelse($this->topBrowsersData as $browserData)
                            <li class="flex items-center py-4 space-x-3">
                                <div class="flex-shrink-0">
                                    <x-svg svg="browser" class="w-8 h-8 text-blue-500 rounded-full"/>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $browserData['browser'] }} : {{ $browserData['screenPageViews'] }} {{ __('Visits') }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="flex items-center py-4 space-x-3">
                                <div class="w-full pt-10 text-center">
                                    <div class="flex flex-col justify-center text-base font-semibold text-gray-700">
                                        <x-svg class="w-8 h-8 mx-auto" svg='x'/>
                                        <span>{{ __('No browsers found...') }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-4">
                <h2 class="px-3 py-3 text-lg font-medium text-gray-900 border-b border-gray-200">{{ __('Top Countries') }}</h2>
                <div class="mt-6 flow-root overflow-auto min-h-[200px] max-h-[200px]">
                    <ul role="list" class="-my-4 divide-y divide-gray-200">
                        @forelse($this->topCountriesData as $countryData)
                            <li class="flex items-center py-4 space-x-3">
                                <div class="flex-shrink-0">
                                    <x-svg svg="map" class="w-8 h-8 text-gray-500 rounded-full"/>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $countryData['country'] }} : {{ $countryData['screenPageViews'] }} {{ __('Visits') }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="flex items-center py-4 space-x-3">
                                <div class="w-full pt-10 text-center">
                                    <div class="flex flex-col justify-center text-base font-semibold text-gray-700">
                                        <x-svg class="w-8 h-8 mx-auto" svg='x'/>
                                        <span>{{ __('No browsers found...') }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-4">
                <h2 class="px-3 py-3 text-lg font-medium text-gray-900 border-b border-gray-200">{{ __('Top Countries') }}</h2>
                <div class="mt-6 flow-root overflow-auto min-h-[200px] max-h-[200px]">
                    <ul role="list" class="-my-4 divide-y divide-gray-200">
                        @forelse($this->mostVisitedPagesData as $pagesData)
                            <li class="flex items-center py-4 space-x-3">
                                <div class="flex-shrink-0">
                                    <x-svg svg="link" class="w-8 h-8 text-gray-500 rounded-full"/>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $pagesData['fullPageUrl'] }} : {{ $pagesData['screenPageViews'] }} {{ __('Page Views') }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="flex items-center py-4 space-x-3">
                                <div class="w-full pt-10 text-center">
                                    <div class="flex flex-col justify-center text-base font-semibold text-gray-700">
                                        <x-svg class="w-8 h-8 mx-auto" svg='x'/>
                                        <span>{{ __('No browsers found...') }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
