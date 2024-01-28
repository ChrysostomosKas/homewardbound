@props(['items'])

<div class="flex right-0 items-center bg-gray-100 justify-start">
    <div class="text-sm sm:text-base bg-white p-2 rounded-md">
        <ol class="list-none p-0 inline-flex space-x-2">
            @foreach ($items as $item)
                <li class="flex items-center">
                    @if ($item['link'])
                        <a href="{{ $item['link'] }}" class="{{ $item['linkClass'] ?? 'text-gray-600 hover:text-blue-500 transition-colors duration-300' }}">
                            {{ $item['text'] }}
                        </a>
                    @else
                        <span class="{{ $item['textClass'] ?? 'text-gray-800' }}">
                            {{ $item['text'] }}
                        </span>
                    @endif

                    @if (!$loop->last)
                        <span class="mx-2">/</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</div>
