<div>
    <section class="py-4 shadow-2xl">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 rounded-lg">
            <div class="px-6">
                <div class="flex flex-wrap justify-center">
                    <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                        <div class="relative">
                            <img alt="" src="{{ asset('storage/'.$adoptionAd->base_image) }}"
                                 class="shadow-xl rounded h-auto align-middle border-none">
                        </div>
                    </div>
                </div>
                <div class="text-center mt-12">
                    <h3 class="text-4xl font-semibold leading-normal mb-2 text-gray-700 mb-2">
                        {{ $adoptionAd->title }}
                    </h3>
                    <div class="mb-2 mt-10 capitalize flex justify-center">
                        <x-tabler-paw class="w-6 h-6 mr-2 text-gray-400"/>
                        {{ $adoptionAd->breed }} - {{ $adoptionAd->size }}
                    </div>
                    <div class="mb-2 capitalize flex justify-center">
                        <x-tabler-cake class="w-6 h-6 mr-2 text-gray-400"/>
                        {{ $adoptionAd->age }} {{ $adoptionAd->pet_age_unit }} - {{ $adoptionAd->color }}
                    </div>
                    <div class="mb-2 flex justify-center">
                        @if($adoptionAd->spaying_neutering_status)
                            <x-tabler-checkbox class="w-6 h-6 mr-2 text-green-400"/>
                        @else
                            <x-tabler-circle-x class="w-6 h-6 mr-2 text-red-400"/>
                        @endif
                        Spaying Neutering Status
                    </div>
                    <div class="mb-2 flex justify-center">
                        @if($adoptionAd->vaccination_status)
                            <x-tabler-checkbox class="w-6 h-6 mr-2 text-green-400"/>
                        @else
                            <x-tabler-circle-x class="w-6 h-6 mr-2 text-red-400"/>
                        @endif
                        Vaccination Status
                    </div>
                    <div class="mb-2 capitalize flex justify-center">
                        <x-tabler-info-square-rounded-filled class="w-6 h-6 mr-2 text-gray-400"/>
                        {{ $adoptionAd->health_condition }}
                    </div>
                </div>
                <div class="mt-10 py-10 border-t-2 border-gray-300 text-center">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-9/12 px-4">
                            <p class="mb-4 text-lg leading-relaxed text-gray-700">
                                {{ $adoptionAd->description }}
                            </p>
                            @if($this->interested)
                                <span class="font-normal text-pink-500">{{ __('We will be in touch with you. Thank you!') }}</span>
                            @else
                                <a wire:click="toggleShowForm()" class="font-normal text-pink-500 hover:cursor-pointer">
                                    {{ __('Begin Your Adoption Journey') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                @if(!is_null($adoptionAd->images))
                    <div class="max-w-2xl mx-auto">
                        <div x-data="{ activeSlide: 0 }" id="default-carousel" class="relative" data-carousel="static">
                            <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                                @foreach($adoptionAd->images as $index => $image)
                                    <div x-show="activeSlide === {{ $index }} " class="duration-700 ease-in-out" data-carousel-item>
                                        <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800"></span>
                                        <img src="{{ asset('storage/'.$image) }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                                    </div>
                                @endforeach
                            </div>
                            @if(count($adoptionAd->images) > 1)
                                <button @click="activeSlide = (activeSlide - 1 + {{ count($adoptionAd->images) }}) % {{ count($adoptionAd->images) }}" type="button"
                                        class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                        data-carousel-prev>
                                    <x-tabler-arrow-left class="w-6 h-6 text-white bg-gray-900 rounded-full"/>
                                </button>
                            @endif
                            @if(count($adoptionAd->images) > 1)
                                <button @click="activeSlide = (activeSlide + 1) % {{ count($adoptionAd->images) }}" type="button"
                                        class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                        data-carousel-next>
                                    <x-tabler-arrow-right class="w-6 h-6 text-white bg-gray-900 rounded-full"/>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if($this->showForm)
        <livewire:adoption-interest-form :ad_id='$adoptionAd->id'/>
    @endif
</div>
