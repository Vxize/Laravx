@props([
    'size' => 'lg:text-2xl md:text-xl text-lg',
    'margin' => 'my-4',
    'text',
])
@php
    $text_class = $size.' '.$margin;
@endphp
<h4 {{ $attributes->merge(['class' => $text_class]) }}>
    {{ $text ?? $slot }}
</h4>