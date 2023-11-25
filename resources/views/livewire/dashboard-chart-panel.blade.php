<div>
    <div class="max-w-3xl lg:max-w-7xl mt-4 shadow-md">
        <div class="bg-white shadow sm:rounded-lg p-4">
            @if (isset($lineChartModel))
                <div class="card-body h-[250px]">
                    <livewire:livewire-line-chart key="{{ $lineChartModel->reactiveKey() }}"
                                                  :line-chart-model="$lineChartModel"/>
                </div>
            @else
                <div class="flex justify-center text-lg text-gray-600 font-bold bg-gray-200">
                    {{ __('No monthly stats yet.') }}
                </div>
            @endif
        </div>
    </div>
</div>
