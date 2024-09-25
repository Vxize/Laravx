@props([
    'margin' => 'ml-1',
    'padding' => 'py-1 px-2',
    'textSize' => 'text-xs',
    'color' => 'blue',
    'rounded' => 'rounded-full',
    'text' => null,
])
@php
switch ($color) {
    case 'gray':
        $color_class = 'bg-gray-500 text-gray-50';
        break;
    case 'red':
        $color_class = 'bg-red-500 text-red-50';
        break;
    case 'yellow':
        $color_class = 'bg-yellow-500 text-yellow-50';
        break;
    case 'green':
        $color_class = 'bg-green-500 text-green-50';
        break;
    case 'indigo':
        $color_class = 'bg-indigo-500 text-indigo-50';
        break;
    case 'purple':
        $color_class = 'bg-purple-500 text-purple-50';
        break;
    case 'pink':
        $color_class = 'bg-pink-500 text-pink-50';
        break;
    default:
        $color_class = 'bg-blue-500 text-blue-50';
        break;
}
$badge_class = $margin.' '.$padding.' '.$textSize.' '.$color_class.' '.$rounded;
@endphp
<span {{ $attributes->merge(['class' => $badge_class]) }}>
    {{ $text ?? $slot }}
</span>