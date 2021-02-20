@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-xs uppercase py-3 font-bold block text-green-500 hover:text-green-600'
            : 'text-xs uppercase py-3 font-bold block text-gray-600 hover:text-gray-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
