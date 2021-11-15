@props([
    'size' => 'lg:text-xl md:text-lg text-base',
    'margin' => 'my-4',
    'text',
])
@php
    $text_class = $size.' '.$margin;
@endphp
<h5 {{ $attributes->merge(['class' => $text_class]) }}>
    {{ $text ?? $slot }}
</h5>