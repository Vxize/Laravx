@props([
    'value',
    'display' => 'block',
    'margin' => 'm-2',
    'weight' => 'font-medium',
    'size' => 'lg:text-xl md:text-lg text-base',
    'select' => 'select-none',
    'escaped' => false,
])
@php
    $class = implode(' ', [$display, $margin, $weight, $size, $select]);
@endphp

<label {{ $attributes->merge(['class' => $class]) }}>
    @if ($escaped)
        {!! $value ?? $slot !!}
    @else
        {{ $value ?? $slot }}
    @endif
</label>