    <div>
        <div class="relative px-4">
            <div class="relative mx-auto max-w-7xl">
                <div class="mx-auto mt-12 grid gap-5 lg:max-w-none lg:grid-cols-3 p-4">
                    @foreach($adoptionAds as $ad)
                        <div
                            class="flex flex-col overflow-hidden rounded-lg shadow-lg h-[550px] transform hover:scale-105 transition-all ease-in-out duration-300">
                            <img class="rounded-t-lg"
                                 src="https://picsum.photos/800/600/?category=animals"
                                 alt=""/>
                            <div class="py-6 px-8 rounded-lg bg-white">
                                <a href="{{ route('adoption-ads.show', $ad->id) }}">
                                    <h1 class="text-gray-700 font-bold text-xl mb-3 hover:text-gray-900 line-clamp-2 max-w-[200px]">{{ $ad->title }}</h1>
                                </a>
                                <p class="text-gray-700 tracking-wide line-clamp-4">{{ $ad->description }}</p>
                                <div class="flex justify-between">
                                    <a href="{{ route('adoption-ads.show', $ad->id) }}"
                                        class="mt-6 py-2 px-4 bg-gray-900 text-white font-bold rounded-lg shadow-md hover:shadow-lg hover:bg-gray-700">
                                        Show
                                    </a>
                                    <div class="flex items-center mt-6 gap-2 hover:cursor-pointer"
                                         wire:click="toggleLike({{ $ad->id }})">
                                        <x-tabler-heart
                                            class="w-8 h-8 {{ $hasLiked($ad->id) ? 'text-green-500 fill-green-500' : 'text-gray-300' }} hover:fill-neutral-400 hover:text-gray-400"/>
                                        <span>{{ $ad->likes()->count() }} Likes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-2 right-2 py-2 px-4 bg-white rounded-lg">
                                <span class="text-sm font-semibold">09-12-2023</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $adoptionAds->links() }}
                </div>
            </div>
        </div>
    </div>
