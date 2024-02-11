<div>
    <livewire:adoption-dashboard-summary />
    @if(Gate::allows('admin'))
    <livewire:dashboard-chart-panel />
    @else
        <livewire:user-adoption-interests />
    @endif
</div>
