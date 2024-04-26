<div>
    <div class="flex justify-end mb-4">
        <x-button.icon-button wire:click.prevent="createPinRequestRecord" svg='plus'>{{ __('Pet Reports') }}</x-button.icon-button>
    </div>
    {{ $this->table }}
</div>
