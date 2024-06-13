<div x-data="{ open: false, redirectTo: '' }">
    <div class="flex justify-end mb-4">
        <x-button.icon-button wire:click.prevent="createMedicalRecord" svg='plus'>{{ __('New Medical Folder') }}</x-button.icon-button>
    </div>
    @foreach($medicalRecords as $medicalRecord)
        <div x-data="{ open: false }" class="flex items-center bg-pink-600 rounded-md p-3 text-white cursor-pointer transition duration-500 ease-in-out hover:shadow hover:bg-pink-700 mb-4">
            <div>
                <x-tabler-folder class="w-10 h-10 text-white fill-white"/>
            </div>
            <div class="px-3 mr-auto">
                <h4 class="font-bold">{{ __('Medical Record') }} {{ $medicalRecord->pet->name }}</h4>
                <small class="text-xs">{{ __('created_at') }} {{ $medicalRecord->created_at->format('d-m-Y') }}</small>
            </div>
            <div class="relative">
                <a @click="open = !open">
                    <x-tabler-dots-vertical class="w-6 h-6 text-white"/>
                </a>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="options absolute bg-white text-gray-600 origin-top-right right-0 mt-2 w-56 rounded-md shadow-lg overflow-hidden">
                    <a href="{{ route('medical-records.edit', $medicalRecord->id) }}" class="flex py-3 px-2 text-sm font-bold hover:bg-gray-200">
                        <span class="mr-auto">{{ __('Edit') }}</span>
                        <x-tabler-pencil class="w-6 h-6 text-black"/>
                    </a>
                    <a href="{{ route('appointments.create', ['medical_record_id' => $medicalRecord->id]) }}" class="flex py-3 px-2 text-sm font-bold hover:bg-gray-200">
                        <span class="mr-auto">{{ __('Create Appointment') }}</span>
                        <x-tabler-calendar-plus class="w-6 h-6 text-black"/>
                    </a>
                    @if(!$medicalRecord->pet->petHealth)
                        <a href="{{ route('petHealth.create', ['pet_id' => $medicalRecord->pet->id]) }}" class="flex py-3 px-2 text-sm font-bold hover:bg-gray-200">
                            <span class="mr-auto">{{ __('Add pet health info') }}</span>
                            <x-tabler-file-plus class="w-6 h-6 text-black"/>
                        </a>
                    @else
                        <a href="{{ route('petHealth.edit', $medicalRecord->pet->petHealth->id) }}" class="flex py-3 px-2 text-sm font-bold hover:bg-gray-200">
                            <span class="mr-auto">{{ __('Edit pet health info') }}</span>
                            <x-tabler-file-pencil class="w-6 h-6 text-black"/>
                        </a>
                    @endif
                    <a href="{{ route('medical-records.show', $medicalRecord->id) }}" class="flex py-3 px-2 text-sm font-bold hover:bg-gray-200">
                        <span class="mr-auto">{{ __('Overview') }}</span>
                        <x-tabler-eye class="w-6 h-6 text-black"/>
                    </a>
                    <a id="delete-medicalRecord"
                       data-medicalRecord-id="{{ $medicalRecord->id }}"
                       data-csrf-token="{{ csrf_token() }}"
                       data-modal-show="popup-modal" class="flex py-3 px-2 text-sm font-bold bg-red-500 text-white hover:bg-red-400">
                        <span class="mr-auto">{{ __('Delete') }}</span>
                        <x-tabler-trash class="w-6 h-6 text-white"/>
                    </a>
                </div>
            </div>
        </div>
    @endforeach

        <script>
            $('#delete-medicalRecord').on('click', function() {
                var medicalRecordId = $(this).data('medicalrecord-id');
                var csrfToken = $(this).data('csrf-token');

                const dispatch = function (name, detail) {
                    const event = new CustomEvent(name, {detail});
                    window.dispatchEvent(event);
                }
                    $.ajax({
                        url: "{{ route('medical-records.destroy', ['medical_record' => ':id']) }}".replace(':id', medicalRecordId),
                        type: 'DELETE',
                        data: {_token: csrfToken},
                        success: function (response) {
                            dispatch('notification', {message: response.message, success: true});

                            setTimeout(function () {
                                location.reload();
                            }, 2500);
                        },
                        error: function (response) {
                            dispatch('notification', {message: response.responseJSON.error, success: false});
                        }
                    });
            });
        </script>
</div>
