<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="text-indigo-100 hover:bg-gray-700 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium" type="submit">
        <x-tabler-logout class="w-6 h-6 text-white"/>
        {{ __('Log out') }}
    </button>
</form>
