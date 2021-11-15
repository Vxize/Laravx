@props([
    'size' => 'lg:text-lg md:text-base text-sm',
    'margin' => 'my-4',
    'text',
])
@php
    $text_class = 'leading-normal '.$size.' '.$margin;
@endphp
<p {{ $attributes->merge(['class' => $text_class]) }}>
    {{ $text ?? $slot }}
</p>