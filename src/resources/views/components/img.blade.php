@props([
    'width' => 'w-full',
    'margin' => 'mx-auto my-4',
])
@php
    $img_class = 'rounded-lg shadow-lg '.$width.' '.$margin;
@endphp
<img {{ $attributes->merge(['class' => $img_class]) }} >