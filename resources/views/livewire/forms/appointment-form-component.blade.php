<div>
    <form wire:submit.prevent="saveAppointment">

        {{ $this->form }}

        <div class="flex justify-end py-3 pr-3 md:pr-0">
            <x-button.primary>{{ __('Submit') }}</x-button.primary>
        </div>

    </form>
</div>
