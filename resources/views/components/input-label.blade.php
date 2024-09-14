@props(['value'])

<label {{ $attributes->merge(['class' => 'input-box']) }}>
    {{ $value ?? $slot }}
</label>
