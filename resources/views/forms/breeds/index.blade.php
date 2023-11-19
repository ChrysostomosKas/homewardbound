<x-app-layout title=''>

        @if(Gate::allows('admin'))
        <livewire:datatables.selection-breed-component />
        @endif

</x-app-layout>
