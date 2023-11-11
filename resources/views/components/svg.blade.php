@props(['svg'])
<x-dynamic-component :component="'tabler-'.$svg" {{ $attributes }} />
