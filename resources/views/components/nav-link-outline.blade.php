@props(['active'])

@php
$classes = ($active ?? false)
            ? 'btn-outline-orange bg-orange-100'
            : 'btn-outline-orange';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
