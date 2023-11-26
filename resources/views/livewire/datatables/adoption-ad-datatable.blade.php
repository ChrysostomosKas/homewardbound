<div>
    <div class="relative px-4">
        <div class="relative mx-auto max-w-7xl">
            <div class="mx-auto mt-12 grid gap-5 lg:max-w-none lg:grid-cols-3 p-4">
                @foreach($adoptionAds as $ad)
                <div class="flex flex-col overflow-hidden rounded-lg shadow-lg h-[400px] transform hover:scale-105 transition-all ease-in-out duration-300 hover:cursor-pointer">
                    <div class="flex flex-1 flex-col justify-between bg-white p-6">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover rounded" src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80" alt="">
                        </div>
                        <div class="flex flex-col justify-between flex-1 p-6 bg-white">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-indigo-600 text-center">{{ $ad->created_at->format('m-d-Y') }}</p>
                                <p class="text-lg font-semibold text-gray-900 text-center line-clamp-1">{{ $ad->title }}</p>
                                <p class="mt-3 text-base text-gray-500 line-clamp-4">{{ $ad->description }}</p>
                            </div>
                        </div>
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
