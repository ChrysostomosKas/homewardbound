<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>
    <div class="flex justify-center self-center z-10">
        <div class="p-12 bg-white mx-auto rounded-3xl w-96 ">
            <div class="mb-7">
                <h3 class="font-semibold text-2xl text-black">Login In </h3>
                <p class="text-black">Don'thave an account? <a href="{{ route('register') }}"
                                                               class="text-sm text-purple-700 hover:text-purple-700">Sign
                        Up</a></p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
            <div class="space-y-6">
                <div>
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                  required autofocus autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')"/>

                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>
                <div class="flex items-center justify-between">
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                   name="remember">
                            <span
                                class="ml-2 text-sm text-black font-semibold">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-black rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <div>
                    <x-primary-button class="ml-3 bg-red-500 hover:bg-red-700">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
                <div class="flex items-center justify-center space-x-2 my-5">
                    <span class="h-px w-16 bg-black"></span>
                    <span class="text-black font-normal">OR</span>
                    <span class="h-px w-16 bg-black"></span>
                </div>
                <div class="flex justify-center gap-5 w-full">
                    <a href="{{ route('auth.google') }}"
                            class="w-full flex items-center justify-center mb-6 md:mb-0 border border-gray-600 hover:border-gray-900 hover:bg-gray-900 text-sm text-gray-500 p-3  rounded-lg tracking-wide font-medium  cursor-pointer transition ease-in duration-500">
                        <x-tabler-brand-google class="w-6 mr-2 h-6 text-black"/>

                        <span class="text-black">Google</span>
                    </a>

                    <a href="/auth/github/redirect" class="w-full flex items-center justify-center mb-6 md:mb-0 border border-gray-300 hover:border-gray-900 hover:bg-gray-900 text-sm text-gray-500 p-3  rounded-lg tracking-wide font-medium  cursor-pointer transition ease-in duration-500 px-2">
                        <x-tabler-brand-github-filled class="w-6 mr-2 h-6 text-black"/>
                        <span class="text-black">Github</span>
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>

</x-guest-layout>
