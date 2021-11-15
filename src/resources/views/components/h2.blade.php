@props([
    'size' => 'lg:text-4xl md:text-3xl text-2xl',
    'align' => 'text-center',
    'color' => 'text-green-800',
    'margin' => 'my-6',
    'text',
])
@php
    $text_class = 'font-semibold '.$size
        .' '.$margin
        .' '.$align
        .' '.$color
        ;
@endphp
<h2 {{ $attributes->merge(['class' => $text_class]) }}>
    {{ $text ?? $slot }}
</h2>