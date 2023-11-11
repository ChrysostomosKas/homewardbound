<div
    x-data="{ open:false,  message: this.message, success:true }"

    aria-live="assertive" class="fixed inset-0 z-50 flex items-end w-auto px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
    <div
        x-cloak
        x-show='open'
        @notification.window="
      open=true;
      message = event.detail[0].message
      success = event.detail[0].success
      setTimeout(() => open = false, 3000)
    "
        x-transition.duration.350ms
        class="flex flex-col items-center w-full space-y-4 sm:items-end">

        <div class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <x-tabler-circle-check x-show='success'  class="w-6 h-6 text-green-400"/>
                        <x-tabler-circle-x x-show='!success'  class="w-6 h-6 text-red-400"/>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p x-html="success ? '{{__('Success')}}' : '{{__('Failed')}}' " class="text-sm font-medium text-gray-900"></p>
                        <p x-html="message" class="mt-1 text-sm text-gray-500"></p>
                    </div>
                    <div class="flex flex-shrink-0 ml-4">
                        <button @click="open = false" type="button" class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <x-tabler-x class="h-4 w-4" />;
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
