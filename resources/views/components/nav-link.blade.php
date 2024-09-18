@props(['active'])

@php
$classes = ($active ?? false) ? 'inline-flex active' : 'inline-flex inactive';
@endphp

<a {{ $attributes->merge(['class' => $classes ]) }}>
    {{ $slot }}
</a>
