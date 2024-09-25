@props([
    'value',
    'display' => 'block',
    'escaped' => false,
])

<label {{ $attributes->merge(['class' => 'm-2 font-medium lg:text-xl md:text-lg text-base select-none '.$display]) }}>
    @if ($escaped)
        {!! $value ?? $slot !!}
    @else
        {{ $value ?? $slot }}
    @endif
</label>
