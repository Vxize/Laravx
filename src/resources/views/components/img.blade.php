@props([
    'width' => 'w-full',
    'margin' => 'mx-auto my-4',
    'border' => 'border border-gray-200 rounded-lg shadow-lg'
])
@php
    $img_class = $border.' '.$width.' '.$margin;
@endphp
<img {{ $attributes->merge(['class' => $img_class]) }} >