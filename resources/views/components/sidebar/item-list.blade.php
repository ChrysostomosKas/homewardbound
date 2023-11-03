<x-sidebar.item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard.*')" icon="home">{{ __('Home') }}</x-sidebar.item>
<x-sidebar.item href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.*')" icon="user">{{ __('Profile') }}</x-sidebar.item>
<x-sidebar.item href="#" :active="request()->routeIs('#.*')" icon="paw">{{ __('Pet List') }}</x-sidebar.item>
<x-sidebar.item href="#" :active="request()->routeIs('#.*')" icon="heartbeat">{{ __('Adoption') }}</x-sidebar.item>
<x-sidebar.item href="#" :active="request()->routeIs('#.*')" icon="medical-cross">{{ __('Medical') }}</x-sidebar.item>
<x-sidebar.item href="#" :active="request()->routeIs('#.*')" icon="map-pin">{{ __('Pet Reports') }}</x-sidebar.item>
<x-sidebar.item href="#" :active="request()->routeIs('#.*')" icon="presentation-analytics">{{ __('Analytics') }}</x-sidebar.item>
<x-sidebar.item href="#" :active="request()->routeIs('#.*')" icon="device-analytics">{{ __('Statistics ') }}</x-sidebar.item>
<div class="px-2 py-1">
    <x-button.logout/>
</div>
