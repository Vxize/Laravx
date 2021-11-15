@props([
    'width' => 'w-full',
    'maxWidth' => 'max-w-full',
    'margin' => 'mx-auto my-6',
    'padding' => 'p-6',
    'size' => 'lg:text-2xl md:text-xl text-lg',
    'color' => 'blue',
    'align' => 'text-center',
    'escaped' => false,
    'text',
])
@php
switch ($color) {
    case 'gray':
        $color_class = 'bg-gray-200 text-gray-700';
        break;
    case 'red':
        $color_class = 'bg-red-200 text-red-700';
        break;
    case 'yellow':
        $color_class = 'bg-yellow-200 text-yellow-700';
        break;
    case 'green':
        $color_class = 'bg-green-200 text-green-700';
        break;
    case 'indigo':
        $color_class = 'bg-indigo-200 text-indigo-700';
        break;
    case 'purple':
        $color_class = 'bg-purple-200 text-purple-700';
        break;
    case 'pink':
        $color_class = 'bg-pink-200 text-pink-700';
        break;
    default:
        $color_class = 'bg-blue-200 text-blue-700';
        break;
}
@endphp
<div class="leading-relaxed font-bold rounded-lg shadow-lg
    {{ $width }}
    {{ $maxWidth }}
    {{ $margin }}
    {{ $padding }}
    {{ $size }}
    {{ $align }}
    {{ $color_class }}
">
    @if (isset($escaped) && $escaped)
        {!! $text ?? $slot !!}
    @else
        {{ $text ?? $slot }}
    @endif
</div>