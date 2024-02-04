<div>
    <div class="p-5 text-center font-semibold text-2xl">
        <h1 class="leading-7 text-indigo-600">{{ __('Statistics') }}</h1>
    </div>

    <div class="mt-4">
        <select wire:model.live="time_range" id="time_range"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value='0' selected>{{ __('Select Time Range') }}</option>
            <option value='week'>{{ __('Per week') }}</option>
            <option value='month'>{{ __('Per month') }}</option>
            <option value='year'>{{ __('Per year') }}</option>
        </select>
    </div>

    <div class="mt-5">
        @if (isset($lineChartModel))
            <div class="mt-10 card-body h-[500px]">
                <livewire:livewire-line-chart key="{{ $lineChartModel->reactiveKey() }}"
                                              :line-chart-model="$lineChartModel"/>
            </div>
        @else
            <div class="flex justify-center text-lg text-gray-600 font-bold bg-gray-200">
                {{ __('There are no statistics yet.') }}
            </div>
        @endif
    </div>
</div>
