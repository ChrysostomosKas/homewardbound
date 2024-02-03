@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-indigo-700 text-black focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
