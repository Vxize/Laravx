@props([
    'prefix' => 'fas fa-fw',
    'icon' => 'info-circle',
])
@php
    $icon_class = $prefix.' fa-'.$icon;
@endphp
<i {{ $attributes->merge(['class' => $icon_class]) }}></i>