@props([
    'value',
    'display' => 'block'
])

<label {{ $attributes->merge(['class' => 'm-2 font-medium lg:text-xl md:text-lg text-base select-none '.$display]) }}>
    {{ $value ?? $slot }}
</label>
