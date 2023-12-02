@props([
    'width' => 'w-full',
    'maxWidth' => 'max-w-full',
    'margin' => 'mx-auto my-8',
    'padding' => 'p-4',
    'display' => 'block',
    'textSize' => 'lg:text-2xl md:text-xl text-lg',
    'textColor' => 'text-white',
    'color' => 'blue',
    'text' => __('lavx::sys.save'),
    'iconPrefix' => 'iconify-inline inline-block',
    'icon' => 'fa-solid:save',
    'disabled' => false,
])
@php
switch ($color) {
    case 'gray':
        $color_class = 'bg-gray-500 hover:bg-gray-300';
        break;
    case 'red':
        $color_class = 'bg-red-600 hover:bg-red-300';
        break;
    case 'yellow':
        $color_class = 'bg-yellow-500 hover:bg-yellow-300';
        break;
    case 'green':
        $color_class = 'bg-green-600 hover:bg-green-300';
        break;
    case 'indigo':
        $color_class = 'bg-indigo-500 hover:bg-indigo-300';
        break;
    case 'purple':
        $color_class = 'bg-purple-600 hover:bg-purple-300';
        break;
    case 'pink':
        $color_class = 'bg-pink-500 hover:bg-pink-300';
        break;
    default:
        $color_class = 'bg-blue-600 hover:bg-blue-300';
        break;
}
@endphp
<button type="submit" {{ $disabled ? 'disabled' : '' }}
    class="no-underline text-center font-bold rounded-lg shadow-lg uppercase tracking-widest cursor-pointer outline-none focus:outline-none disabled:opacity-50
        {{ $width }}
        {{ $maxWidth }}
        {{ $margin }}
        {{ $padding }}
        {{ $display }}
        {{ $textSize  }}
        {{ $textColor }}
        {{ $color_class }}
        {{ $disabled ? 'opacity-30' : '' }}
    "
>
    @if ($icon)
        <x-lavx::icon prefix="{{ $iconPrefix }}" icon="{{ $icon }}" />
    @endif
    {{ $text ?? $slot }}
</button>