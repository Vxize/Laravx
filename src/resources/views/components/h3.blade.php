@props([
    'size' => 'lg:text-3xl md:text-2xl text-xl',
    'margin' => 'my-5',
    'text',
])
@php
    $text_class = 'font-medium '.$size.' '.$margin;
@endphp
<h3 {{ $attributes->merge(['class' => $text_class]) }}>
    {{ $text ?? $slot }}
</h3>