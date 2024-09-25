@props([
    'width' => 'max-w-md',
    'margin' => 'mx-auto my-6',
    'padding' => 'p-6',
    'background' => 'bg-white',
    'border' => 'border',
    'rounded' => 'rounded-xl',
    'shadow' => 'shadow-xl',
    'default' => 'w-full'
])
@php
    $box_class = [
        $default,
        $rounded,
        $shadow,
        $margin,
        $border,
        $padding,
        $background,
    ];
    $widths = [
        'max-w-xs',
        'max-w-sm',
        'max-w-md',
        'max-w-lg',
        'max-w-xl',
        'max-w-2xl',
        'max-w-3xl',
        'max-w-4xl',
        'max-w-5xl',
        'max-w-6xl',
        'max-w-7xl',
    ];
    if (in_array($width, $widths)) {
        $box_class[] = $width;
        $property = [
            'class' => implode(' ', $box_class),
        ];
    } else {
        $property = [
            'class' => implode(' ', $box_class),
            'width' => $width,
        ];
    }
@endphp
<div {{ $attributes->merge($property) }} >
    {{ $slot }}
</div>