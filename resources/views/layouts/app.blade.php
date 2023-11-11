    <!DOCTYPE html>
    <html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite('resources/css/app.css')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('header_scripts')
        @stack('scripts')
        @livewireStyles
        @filamentStyles
    </head>
    <body class="h-full overflow-hidden">
    <div class="h-full flex">
        <div class="hidden w-28 bg-gray-800 md:block">
            <div class="w-full py-6 flex flex-col items-center">

                <div class="flex-1 mt-6 w-full px-2 space-y-1">
                    <x-sidebar.item-list/>
                </div>
            </div>
        </div>

        <x-sidebar.mobile/>

        <!-- Content area -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <x-notification/>

            <x-dash-nav/>

            <x-dash-container>

                {{ $slot }}

            </x-dash-container>
        </div>
    </div>
    @livewireScripts
    @filamentScripts
    </body>
    </html>
