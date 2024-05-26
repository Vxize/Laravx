@props([
    'width' => 'w-full',
    'maxWidth' => 'max-w-full',
    'margin' => 'mx-auto my-8',
    'padding' => 'p-4',
    'display' => 'block',
    'textSize' => 'lg:text-2xl md:text-xl text-lg',
    'textColor' => 'text-white',
    'color' => 'blue',
    'round' => 'rounded-lg',
    'shadow' => 'shadow-lg',
    'text' => __('lavx::sys.back'),
    'iconPrefix' => 'iconify-inline inline-block',
    'icon' => 'fa-solid:undo',
    'iconRight' => '',
    'link' => '',
    'external' => false,
    'type' => '',
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
$cursor = $link === '_' ? 'cursor-not-allowed' : 'cursor-pointer';
@endphp
@if ($type === 'button' || $link === '_')
<button
@else
<a
@endif
    class="no-underline text-center font-bold uppercase tracking-widest outline-none focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed
        {{ $width }}
        {{ $maxWidth }}
        {{ $margin }}
        {{ $padding }}
        {{ $display }}
        {{ $round }}
        {{ $shadow }}
        {{ $textSize  }}
        {{ $textColor }}
        {{ $color_class }}
        {{ $cursor }}
        {{ $link ? '' : 'opacity-30' }}
    "
    @if ($link === '_')
        disabled
    @else
        href="{{ $link }}"
    @endif
    
    @if ($external)
        rel="noopener noreferrer" target="_blank"
    @endif

    {{ $attributes }}
>
    @if ($icon)
        <x-lavx::icon prefix="{{ $iconPrefix }}" icon="{{ $icon }}" />
    @endif
    {{ $text }}
    @if ($iconRight)
        <x-lavx::icon prefix="{{ $iconPrefix }}" icon="{{ $iconRight }}" />
    @endif
@if ($type === 'button' || $link === '_')
</button>
@else
</a>
@endif