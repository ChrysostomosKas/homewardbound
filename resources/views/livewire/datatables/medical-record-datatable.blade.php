<div>
    <div class="flex justify-end mb-4">
        <x-button.icon-button wire:click.prevent="createMedicalRecord" svg='plus'>{{ __('New Medical Folder') }}</x-button.icon-button>
    </div>
    {{ $this->table }}
</div>
