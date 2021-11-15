@props([
    'size' => 'lg:text-xl md:text-lg text-base',
    'margin' => 'my-4 ml-10',
])
@php
    $text_class = 'list-decimal '.$size.' '.$margin;
@endphp
<ol {{ $attributes->merge(['class' => $text_class]) }}>
    {{ $slot }}
</ol>