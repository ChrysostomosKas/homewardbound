<div>
    <div class="flex justify-end mb-4">
        <x-button.icon-button wire:click.prevent="createBreedRecord" svg='plus'>{{ __('New Breed') }}</x-button.icon-button>
    </div>

    {{ $this->table }}
</div>
