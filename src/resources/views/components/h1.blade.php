@props([
    'size' => 'lg:text-5xl md:text-4xl text-3xl',
    'align' => 'text-center',
    'color' => 'text-blue-800',
    'margin' => 'my-7',
    'text',
])
@php
    $text_class = 'font-bold lg:leading-tight '.$size
        .' '.$margin
        .' '.$align
        .' '.$color
        ;
@endphp
<h1 {{ $attributes->merge(['class' => $text_class]) }}>
    {{ $text ?? $slot }}
</h1>