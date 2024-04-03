<div class="flex justify-center mt-4">
    <div x-data="{ activeSlide: 0 }">
        <div class="mt-8 border-b">
            <h2 class="text-2xl font-bold tracking-tight text-gray-500 sm:text-4xl mb-4">{{ __('Similar Adoption Ads') }}</h2>
            <div class="flex justify-end w-[400px]" x-ref="carousel">
                @foreach($adoptionAds as $index => $ad)
                    <div x-show="activeSlide === {{ $index }}"
                         class="flex flex-col overflow-hidden rounded-lg shadow-lg h-auto">
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
                                <a href="{{ route('adoption-ads.show', $ad->id) }}"
                                   class="mt-6 py-2 px-4 bg-gray-900 text-white font-bold rounded-lg shadow-md hover:shadow-lg hover:bg-gray-700">
                                    {{ __('Show') }}
                                </a>
                                <div class="flex items-center mt-6 gap-2">
                                    <x-tabler-heart
                                        class="w-8 h-8 text-red-500 fill-red-500"/>
                                    <span>{{ $ad->likes()->count() }} Likes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="inset-x-0 bottom-0 flex justify-center mt-4 items-center mb-2">
                <button @click="activeSlide = (activeSlide === 0) ? {{ count($adoptionAds) - 1 }} : activeSlide - 1"
                        class="h-10 w-10 rounded-full bg-gray-800 text-white flex items-center justify-center focus:outline-none mr-2">
                    <x-svg svg="arrow-left"/>
                </button>
                @foreach($adoptionAds as $index => $ad)
                    <button @click="activeSlide = {{ $index }}"
                            :class="{ 'bg-gray-800': activeSlide === {{ $index }}, 'bg-gray-400': activeSlide !== {{ $index }} }"
                            class="h-3 w-3 rounded-full mx-1 focus:outline-none"></button>
                @endforeach
                <button @click="activeSlide = (activeSlide === {{ count($adoptionAds) - 1 }}) ? 0 : activeSlide + 1"
                        class="h-10 w-10 rounded-full bg-gray-800 text-white flex items-center justify-center focus:outline-none ml-2">
                    <x-svg svg="arrow-right"/>
                </button>
            </div>
        </div>
    </div>
</div>
