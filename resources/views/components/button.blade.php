<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gray-800 border border-transparent rounded-md shadow-sm hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
