<x-sidebar.item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard.*')" icon="home">{{ __('Home') }}</x-sidebar.item>
<x-sidebar.item href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.*')" icon="user">{{ __('Profile') }}</x-sidebar.item>
<div class="px-2 py-1">
    <x-button.logout/>
</div>
