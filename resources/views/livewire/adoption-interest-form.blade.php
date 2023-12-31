<div class="mt-4">
    <form wire:submit.prevent="saveAdoptionInterest">

        {{ $this->form }}

        <div class="flex justify-end py-3 pr-3 md:pr-0">
            <x-button.primary class="bg-pink-500 hover:bg-pink-600">{{ __('Submit') }}</x-button.primary>
        </div>

    </form>
</div>
