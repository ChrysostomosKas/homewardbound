<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded bg-green-600 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm transition text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white']) }}>
    {{ $slot }}
</button>
