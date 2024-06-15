    <div x-data="{open: false, buttonText: 'Show Filters'}"
    >
        <div class="flex justify-end mt-4 space-x-2">
                <x-button.icon-button class="bg-gray-500 hover:bg-gray-600" href="{{ route('adoption-ads.create') }}" svg='plus'>{{ __('Create an Ad') }}</x-button.icon-button>
                <x-button.icon-button
                    @click="open=!open"
                    x-text="open ? '{{ __('Hide Filters') }}' : '{{ __('Show Filters') }}'"
                    class="bg-gray-500 hover:bg-gray-600">
                <span x-text="buttonText"></span></x-button.icon-button>
        </div>

        <div x-show="open" class="bg-white shadow-lg rounded-md p-6 mt-4">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-pink-600 flex items-center justify-center rounded-lg shadow-lg mr-4">
                    <x-tabler-filters class="w-10 h-10 text-white fill-white"/>
                </div>
                <div>
                    <h4 class="text-2xl font-semibold text-gray-800">{{ __('Filters') }}</h4>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-2">
               @foreach($this->filters as $index => $filter)
                <div>
                    <label class="inline-flex mt-3">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-purple-600"
                               wire:click.debounce="$toggle('filters.{{ $index }}')"
                        ><span class="ml-2 text-gray-700">{{ $index }}</span>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="relative px-4">
            <div class="relative mx-auto max-w-7xl">
                <div class="mx-auto mt-12 grid gap-5 lg:max-w-none lg:grid-cols-3 p-4">
                    @foreach($this->adoptionAds as $ad)
                        <div
                            class="flex flex-col overflow-hidden rounded-lg shadow-lg h-[550px] transform hover:scale-105 transition-all ease-in-out duration-300">
                            <img class="rounded-t-lg object-cover h-64 w-full"
                                 src="{{ asset('storage/'.$ad->base_image) }}"
                                 alt="Ad Image">
                            <div class="py-6 px-8 rounded-lg bg-white">
                                @if($ad->user_id == auth()->id())
                                    <a href="{{ route('adoption-ads.edit', $ad->id) }}">
                                        <h1 class="text-gray-700 font-bold text-xl mb-3 hover:text-gray-900 ">{{ $ad->title }}</h1>
                                    </a>
                                @else
                                    <a href="{{ route('adoption-ads.show', $ad->id) }}">
                                        <h1 class="text-gray-700 font-bold text-xl mb-3 hover:text-gray-900 ">{{ $ad->title }}</h1>
                                    </a>
                                @endif
                                <p class="text-gray-700 tracking-wide line-clamp-4">{{ $ad->description }}</p>
                                <div class="flex justify-between">
                                    @if($ad->user_id == auth()->id())
                                        <a href="{{ route('adoption-ads.edit', $ad->id) }}"
                                           class="mt-6 py-2 px-4 bg-yellow-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg hover:bg-yellow-700">
                                            {{ __('Edit') }}
                                        </a>
                                    @else
                                    <a href="{{ route('adoption-ads.show', $ad->id) }}"
                                        class="mt-6 py-2 px-4 bg-gray-900 text-white font-bold rounded-lg shadow-md hover:shadow-lg hover:bg-gray-700">
                                        {{ __('Show') }}
                                    </a>
                                    @endif
                                    <div class="flex items-center mt-6 gap-2 hover:cursor-pointer"
                                         wire:click="toggleLike({{ $ad->id }})">
                                        <x-tabler-heart
                                            class="w-8 h-8 {{ $this->hasLike($ad->id) ? 'text-green-500 fill-green-500' : 'text-gray-300' }} hover:fill-neutral-400 hover:text-gray-400"/>
                                        <span>{{ $ad->likes()->count() }} Likes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-2 right-2 py-2 px-4 bg-white rounded-lg">
                                <span class="text-sm font-semibold">{{ $ad->created_at->format('d-m-Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $this->adoptionAds->links() }}
                </div>
            </div>
        </div>
    </div>
