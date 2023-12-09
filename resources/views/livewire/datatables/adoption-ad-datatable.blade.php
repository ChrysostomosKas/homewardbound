<div>
    <div class="relative px-4">
        <div class="relative mx-auto max-w-7xl">
            <div class="mx-auto mt-12 grid gap-5 lg:max-w-none lg:grid-cols-3 p-4">
                @foreach($adoptionAds as $ad)
                    <div
                        class="flex flex-col overflow-hidden rounded-lg shadow-lg h-[500px] transform hover:scale-105 transition-all ease-in-out duration-300 hover:cursor-pointer">
                        <img class="rounded-t-lg"
                             src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1049&q=80"
                             alt=""/>
                        <div class="py-6 px-8 rounded-lg bg-white">
                            <h1 class="text-gray-700 font-bold text-2xl mb-3 hover:text-gray-900 hover:cursor-pointer">
                                I'm dog
                                for you.</h1>
                            <p class="text-gray-700 tracking-wide line-clamp-4">Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit.
                                Eum, labore. Ea debitis beatae sequi deleniti.</p>
                            <div class="flex justify-between">
                                <button
                                    class="mt-6 py-2 px-4 bg-yellow-400 text-gray-800 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                    Show
                                </button>
                                <div class="flex items-center mt-6 gap-2">
                                    <x-tabler-heart
                                        class="w-8 h-8 text-gray-300 hover:fill-neutral-400 hover:text-gray-400"/>
                                    <span>2.089 likes</span>
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
