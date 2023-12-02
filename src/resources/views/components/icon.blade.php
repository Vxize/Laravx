@props([
    'prefix' => 'iconify-inline inline-block',
    'icon' => 'fa-solid:info-circle',
])
<i {{ $attributes->merge(['class' => $prefix]) }} data-icon="{{$icon}}"></i>