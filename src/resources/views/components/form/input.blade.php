@props([
    'disabled' => false,
    'checked' => false,
    'required' => false,
    'readonly' => false,
    'name' => '',
    'label' => '',
    'labelDisplay' => 'block',
    'labelEscaped' => false,
    'helper' => '',
    'id' => null,
    'rounded' => 'rounded-lg',
    'shadow' => 'shadow-sm',
    'display' => 'block',
    'margin' => 'mt-1',
    'width' => 'w-full',
    'maxWidth' => '',
    'border' => 'border-gray-300',
    'focus' => 'focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
    'placeholderColor' => 'placeholder-gray-400',
    'cursor' => 'disabled:cursor-not-allowed',
])
@php
    $input_class = implode(' ', [
        $rounded, $shadow, $display, $margin, $width, $maxWidth,
        $border, $focus, $placeholderColor, $cursor
    ]);
@endphp
@if ($label)
    @if ($labelEscaped)
        <x-lavx::form.label for="{{ $name }}" :escaped="true" value="{!! $label !!}" display="{{ $labelDisplay }}" />
    @else
        <x-lavx::form.label for="{{ $name }}" value="{{ $label }}" display="{{ $labelDisplay }}" />
    @endif
@endif
<input
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => $input_class]) }}
    @required($required)
    @disabled($disabled)
    @checked($checked)
    @readonly($readonly)
>
@if ($helper)
    <x-lavx::form.helper class="text-gray-400" :text="$helper" />
@endif