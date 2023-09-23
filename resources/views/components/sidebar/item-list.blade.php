<x-sidebar.item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard.*')" icon="home">{{ __('Home') }}</x-sidebar.item>
<div class="px-2 py-1">
    <x-button.logout/>
</div>
