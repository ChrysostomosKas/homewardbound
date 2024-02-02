@props([
    'svg' => 'point'
])

<a type='button' {{ $attributes->merge([
    'class' => 'inline-flex cursor-pointer justify-center px-4 py-2 text-sm font-medium text-white bg-gray-900 border border-gray-300 rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900',
    ]) }}>
    <x-svg class="w-5 h-5 mr-2 -ml-1 text-white" svg="{{ $svg }}" />
    <span>
        {{ $slot }}
    </span>
</a>
