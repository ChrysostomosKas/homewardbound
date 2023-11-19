<div>
    @if($this->breed_type == '')
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-2xl font-semibold leading-7 text-indigo-600">{{ __('Breed Category List') }}</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">{{ __('Please pick one of the following breed categories to continue') }}</p>
        </div>

        <div class="flex flex-col justify-center items-center mt-4">
            <div class="min-w-[375px] md:min-w-[700px] xl:min-w-[800px] grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-2 2xl:grid-cols-2 3xl:grid-cols-2">
                @foreach($this->petCategories as $category)
                    <div wire:click="selectCategory('{{ $category['name'] }}')" class="flex justify-between items-center border border-gray-200 bg-white shadow-md transition-transform duration-300 transform hover:scale-105 hover:cursor-pointer hover:bg-gray-50">
                        <div class="ml-[18px] flex h-[90px] items-center">
                            <div class="rounded-full p-3 ">
                                <span class="flex items-center text-brand-500 dark:text-white">
                                    <x-dynamic-component :component="'tabler-'.$category['icon']" class="h-7 w-7 text-black" />
                                </span>
                            </div>
                        </div>
                        <div class="ml-[18px] flex h-[90px] items-center p-3">
                            <h4 class="text-xl font-bold text-navy-700 dark:text-white ml-[18px]">{{ $category['name'] }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <livewire:datatables.breedDatatable :breed_type="$this->breed_type"/>
    @endif
</div>
