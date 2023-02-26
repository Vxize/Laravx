@props([
    'prefix' => 'fa-solid fa-fw',
    'icon' => 'circle-info',
])
@php
    $icon_class = $prefix.' fa-'.$icon;
@endphp
<i {{ $attributes->merge(['class' => $icon_class]) }}></i>