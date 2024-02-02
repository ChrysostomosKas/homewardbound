<x-app-layout title=''>
    @if(Gate::allows('admin'))
        <livewire:datatables.medical-record-datatable/>
    @else
        <livewire:health-record-viewer/>
    @endif
</x-app-layout>
