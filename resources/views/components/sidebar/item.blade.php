@props(['active', 'count', 'icon'])

@php
    $isActive = $active ?? false;
    $classes = ($isActive)
        ? 'text-indigo-100 text-center hover:bg-gray-900 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium'
        : 'text-indigo-100 text-center hover:bg-gray-700 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if (isset($icon))
        <x-dynamic-component :component="'tabler-'.$icon" class="w-6 h-6 text-white" />
    @endif
    {{ $slot }}
</a>
