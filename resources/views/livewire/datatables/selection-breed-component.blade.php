<div>
    @if($this->breed_type == '')
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-2xl font-semibold leading-7 text-indigo-600">{{ __('Breed Category List') }}</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">{{ __('Please pick one of the following breed categories to continue') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-x-4 gap-y-28 lg:gap-y-16 mt-16">
            @foreach($this->petCategories as $category)
                <div wire:click="selectCategory('{{ $category['name'] }}')"
                     class="relative group h-48 flex flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg px-4">
                    <a href="#" class="block">
                        <div class="h-28 relative">
                            <div
                                class="absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-40 group-hover:top-[-5%] group-hover:opacity-[0.9] duration-300 w-36 h-36 bg-gray-900 rounded-xl">
                                <span class="w-full h-full flex items-center justify-center">
                                            <x-dynamic-component :component="'tabler-'.$category['icon']"
                                            class="h-14 w-14 text-white"/>
                                </span>
                            </div>
                        </div>
                        <div class="p-6 z-10 w-full">
                            <p class="mb-2 inline-block text-tg text-center text-gray-500 w-full text-xl font-sans font-semibold leading-snug tracking-normal antialiased">
                                {{ $category['name'] }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <livewire:datatables.breedDatatable :breed_type="$this->breed_type"/>
    @endif
</div>
