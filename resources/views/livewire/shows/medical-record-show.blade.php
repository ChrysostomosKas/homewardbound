<div x-data="{open: false, buttonText: 'Show Appointments'}">
    <div class="bg-white shadow-lg rounded-md p-6">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-pink-600 flex items-center justify-center rounded-lg shadow-lg mr-4">
                <x-tabler-folder class="w-10 h-10 text-white fill-white"/>
            </div>
            <div>
                <h4 class="text-2xl font-semibold text-gray-800">Medical Record for {{ $medicalRecord->pet->name }}</h4>
                <p class="text-gray-500">Last Modified: {{ $medicalRecord->updated_at->format('F j, Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Medical History</label>
                <p class="text-gray-800">{{ $medicalRecord->medical_history ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Medications</label>
                <p class="text-gray-800">{{ $medicalRecord->medications ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Allergies</label>
                <p class="text-gray-800">{{ $medicalRecord->allergies ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Emergency Contact Number</label>
                <p class="text-gray-800">{{ $medicalRecord->emergency_contact_number ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Spaying/Neutering Date</label>
                <p class="{{ $medicalRecord->spaying_neutering_date ?? '-' }}"></p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Behavioral Notes</label>
                <p class="text-gray-800">{{ $medicalRecord->behavioral_notes ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a @click="open=!open"
               x-text="open ? 'Hide Appointments' : 'Show Appointments'"
               class="text-indigo-600 font-semibold hover:underline hover:cursor-pointer"><span x-text="buttonText"></span></a>
        </div>
    </div>

    <div x-show="open" class="mt-4">
        {{ $this->table }}
    </div>
</div>
