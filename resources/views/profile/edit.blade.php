<x-app-layout>
    <div x-data="{ openTabMenu: false, tab: 'personalInfo'}">
        <div class="flex flex-row rounded-lg border border-gray-50 bg-white p-6 shadow-lg">
            <div class="relative">
                <img class="w-12 h-12 rounded-md object-cover" src="{{ $user->avatar }}"
                     alt="User" />
            </div>

            <div class="px-6">
                <div class="flex h-8 flex-row">
                    <h2 class="text-lg font-semibold">{{ $user->full_name }}</h2>
                </div>

                <div class="my-2 flex flex-row space-x-2">
                    <div class="flex flex-row">
                        <x-tabler-user-circle class="mr-2 h-6 w-6 text-gray-500"/>

                        <div class="text-sm text-gray-400/80 hover:text-gray-400">{{ $user->roles()->first()->name }}</div>
                    </div>

                    <div class="flex flex-row">
                        <x-tabler-map-pin class="mr-2 h-6 w-6 text-gray-500"/>

                        <div class="text-sm text-gray-400/80 hover:text-gray-400">{{ $user->address }}, {{ $user->city }}, {{ $user->zip_code }}</div>
                    </div>

                    <div class="flex flex-row">
                        <x-tabler-mail class="mr-2 h-6 w-6 text-gray-500"/>

                        <div class="text-sm text-gray-400/80 hover:text-gray-400">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="mt-2 flex flex-row items-center space-x-5">

                </div>
            </div>

            <div class="w-100 flex flex-grow flex-col items-end justify-start">
                <div class="flex flex-row space-x-3">
                    <button
                        @click="openTabMenu=!openTabMenu"
                        x-text="openTabMenu ? 'Close Form' : 'Edit Profile'"
                        class="flex rounded-md bg-gray-900 py-2 px-4 text-white transition-all duration-150 ease-in-out hover:bg-gray-600">
                        <x-tabler-edit class="mr-2 h-6 w-6 text-white"/>
                        <span x-text="openTabMenu"></span>
                    </button>
                </div>
            </div>
        </div>

        <div x-show='openTabMenu' class="border-b border-gray-200 mt-4">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                <li class="me-2">
                    <a
                        :class="{ 'text-indigo-700 bg-gray-200' : tab === 'personalInfo'}" @click="tab = 'personalInfo'"
                        class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-indigo-700 hover:cursor-pointer group">
                        <x-tabler-user-circle class="w-6 h-6 me-2 text-gray-400 group-hover:text-gray-500 hover:cursor-pointer"/>
                        Personal Info
                    </a>
                    <a
                        :class="{ 'text-indigo-700 bg-gray-200' : tab === 'passwordSettings'}" @click="tab = 'passwordSettings'"
                        class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-indigo-700 hover:cursor-pointer group">
                        <x-tabler-password class="w-6 h-6 me-2 text-gray-400 group-hover:text-gray-500 hover:cursor-pointer"/>
                        Password Settings
                    </a>
                    <a
                        :class="{ 'text-indigo-700 bg-gray-200' : tab === 'accountSettings'}" @click="tab = 'accountSettings'"
                        class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-indigo-700 hover:cursor-pointer group">
                        <x-tabler-user-cancel class="w-6 h-6 me-2 text-gray-400 group-hover:text-gray-500 hover:cursor-pointer"/>
                        Account Settings
                    </a>
                </li>
            </ul>
        </div>

        <div x-show='openTabMenu' class="max-w-7xl mt-6 sm:px-6 lg:px-8 space-y-6">
            <div x-show="tab === 'personalInfo'" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div x-show="tab === 'passwordSettings'" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div x-show="tab === 'accountSettings'" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
