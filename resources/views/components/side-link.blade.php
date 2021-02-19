@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-xs uppercase py-3 font-bold block text-green-500 hover:text-pink-600'
            : 'text-xs uppercase py-3 font-bold block text-gray-800 hover:text-gray-600';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
