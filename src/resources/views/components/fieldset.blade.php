@props([
    'class' => 'border-2 rounded-lg m-4 p-4 shadow-lg',
    'legend' => '',
    'color' => '',
    'legend_class' => 'text-center font-bold p-2 lg:text-3xl md:text-2xl text-xl',
    'text',
])
@php
switch ($color) {
    case 'gray':
        $legend_color = 'text-gray-500';
        $border_color = 'border-gray-500';
        break;
    case 'red':
        $legend_color = 'text-red-600';
        $border_color = 'border-red-600';
        break;
    case 'yellow':
        $legend_color = 'text-yellow-700';
        $border_color = 'border-yellow-700';
        break;
    case 'green':
        $legend_color = 'text-green-700';
        $border_color = 'border-green-700';
        break;
    case 'indigo':
        $legend_color = 'text-indigo-700';
        $border_color = 'border-indigo-700';
        break;
    case 'purple':
        $legend_color = 'text-purple-700';
        $border_color = 'border-purple-700';
        break;
    case 'pink':
        $legend_color = 'text-pink-700';
        $border_color = 'border-pink-700';
        break;
    default:
        $legend_color = 'text-blue-700';
        $border_color = 'border-blue-700';
        break;
}
$class .= ' '.$border_color;
$legend_class .= ' '.$legend_color;
@endphp
<fieldset class="{{ $class }}">
    <legend class="{{ $legend_class }}">
        {{ $legend }}
    </legend>
    {{ $text ?? $slot }}
</fieldset>    