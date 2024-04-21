<div
    x-data="{open: false, openHealthPetInfo:false, buttonText: 'Show Appointments', buttonHealthPetInfoText: 'Show health pet information details'}">
    <div class="bg-white shadow-lg rounded-md p-6">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-pink-600 flex items-center justify-center rounded-lg shadow-lg mr-4">
                <x-tabler-folder class="w-10 h-10 text-white fill-white"/>
            </div>
            <div>
                <h4 class="text-2xl font-semibold text-gray-800">{{ __('Medical Record') }} {{ __('for') }} {{ $medicalRecord->pet->name }}</h4>
                <p class="text-gray-500">{{ __('Last Modified:') }} {{ $medicalRecord->updated_at->format('F j, Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">{{ __('Medical History') }}</label>
                <p class="text-gray-800">{{ $medicalRecord->medical_history ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">{{ __('Medications') }}</label>
                <p class="text-gray-800">{{ $medicalRecord->medications ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">{{ __('Allergies') }}</label>
                <p class="text-gray-800">{{ $medicalRecord->allergies ?? '-' }}</p>
            </div>
            <div>
                <label
                    class="block text-gray-700 text-sm font-semibold mb-2">{{ __('Emergency Contact Number') }}</label>
                <p class="text-gray-800">{{ $medicalRecord->emergency_contact_number ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">{{ __('Spaying/Neutering Date') }}</label>
                <p class="text-gray-800">{{ $medicalRecord->spaying_neutering_date->format('d-m-Y') ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">{{ __('Behavioral Notes') }}</label>
                <p class="text-gray-800">{{ $medicalRecord->behavioral_notes ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-4 flex space-x-8">
            <a @click="open=!open"
               x-text="open ? '{{ __('Hide Appointments') }}' : '{{ __('Show Appointments') }}'"
               class="text-indigo-600 font-semibold hover:underline hover:cursor-pointer"><span
                    x-text="buttonText"></span></a>
            @if($medicalRecord->pet->petHealth)
                <a @click="openHealthPetInfo=!openHealthPetInfo"
                   x-text="openHealthPetInfo ? '{{ __('Hide health pet information details') }}' : '{{ __('Show health pet information details') }}'"
                   class="text-indigo-600 font-semibold hover:underline hover:cursor-pointer"><span
                        x-text="buttonHealthPetInfoText"></span></a>
            @endif
        </div>
    </div>

    @if($medicalRecord->pet->petHealth)
        <div x-show="openHealthPetInfo" class="mt-4">
            <div class="max-w-full mx-4 py-6 sm:mx-auto sm:px-6 lg:px-8">
                <div class="sm:flex sm:space-x-4">
                    <div
                        class="bg-white rounded-lg text-left shadow-lg mb-4 w-full sm:w-1/3 sm:my-8">
                        <div class="bg-white p-5">
                            <div class="sm:flex sm:items-start">
                                <div class="text-center sm:mt-0 sm:ml-2 sm:text-left flex items-center space-x-2">
                                    <x-icons.bath />
                                    <p class="text-xl font-bold text-indigo-700">{{ $medicalRecord->pet->petHealth->bathed_at->format('d-m-Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-lg text-left shadow-lg mb-4 w-full sm:w-1/3 sm:my-8">
                        <div class="bg-white p-5">
                            <div class="sm:flex sm:items-start">
                                <div class="text-center sm:mt-0 sm:ml-2 sm:text-left flex items-center space-x-2">
                                    <x-icons.scissors />
                                    <p class="text-xl font-bold text-indigo-700">{{ $medicalRecord->pet->petHealth->hair_condition }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-lg text-left shadow-lg mb-4 w-full sm:w-1/3 sm:my-8">
                        <div class="bg-white p-5">
                            <div class="sm:flex sm:items-start">
                                <div class="text-center sm:mt-0 sm:ml-2 sm:text-left flex items-center space-x-2">
                                    <x-icons.vaccine />
                                    <p class="text-xl font-bold text-indigo-700">{{ $medicalRecord->pet->petHealth->last_vaccination->format('d-m-Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-lg text-left shadow-lg mb-4 w-full sm:w-1/3 sm:my-8">
                        <div class="bg-white p-5">
                            <div class="sm:flex sm:items-start">
                                <div class="text-center sm:mt-0 sm:ml-2 sm:text-left flex items-center space-x-2">
                                    <x-icons.teeth />
                                    <p class="text-xl font-bold text-indigo-700">{{ $medicalRecord->pet->petHealth->teeth_condition }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="flex justify-end mt-4">
        <x-button.icon-button class="bg-pink-500 hover:bg-pink-600"
                              href="{{ route('appointments.create', ['medical_record_id' => $medicalRecord->id]) }}"
                              svg='plus'>{{ __('Create an appointment') }}</x-button.icon-button>
    </div>

    <div x-show="open" class="mt-4">
        {{ $this->table }}
    </div>
</div>
