<x-sidebar.item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard.*')" icon="home">{{ __('Home') }}</x-sidebar.item>
<x-sidebar.item href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.*')" icon="user">{{ __('Profile') }}</x-sidebar.item>
<x-sidebar.item href="{{ route('adoption-ads.index') }}" :active="request()->routeIs('adoption-ads.*')" icon="paw">{{ __('Pet List') }}</x-sidebar.item>
<x-sidebar.item href="{{ route('adoption-interests.index') }}" :active="request()->routeIs('adoption-interests.*')" icon="heartbeat">{{ __('Adoptions') }}</x-sidebar.item>
<x-sidebar.item href="{{ route('medical-records.index') }}" :active="request()->routeIs('medical-records.*')" icon="medical-cross">{{ __('Medical Records') }}</x-sidebar.item>
<x-sidebar.item href="{{ route('report-map.index') }}" :active="request()->routeIs('report-map.*')" icon="map-pin">{{ __('Pet Reports') }}</x-sidebar.item>
@if(Gate::allows('admin'))
    <x-sidebar.item href="{{ route('analytics.index') }}" :active="request()->routeIs('#.*')" icon="presentation-analytics">{{ __('Analytics') }}</x-sidebar.item>
    <x-sidebar.item href="statistics" :active="request()->routeIs('statistics.*')" icon="device-analytics">{{ __('Statistics') }}</x-sidebar.item>
    <x-sidebar.item href="{{ route('users.index') }}" :active="request()->routeIs('users.*')" icon="users">{{ __('Users') }}</x-sidebar.item>
    <x-sidebar.item href="{{ route('report-request') }}" :active="request()->routeIs('report-request.*')" icon="map-check">{{ __('Pet Requests') }}</x-sidebar.item>
@endif
@can('support')
    <x-sidebar.item href="{{ route('breeds.index') }}" :active="request()->routeIs('breeds.*')" icon="list-tree">{{ __('Breeds') }}</x-sidebar.item>
@endcan
