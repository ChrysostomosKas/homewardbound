<x-app-layout title=''>
    @if(Gate::allows('admin'))
        <livewire:datatables.admin-adoption-ad-datatable/>
    @else
        <livewire:datatables.adoption-ad-datatable/>
    @endif
</x-app-layout>
