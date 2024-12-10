@props([
    'disabled' => false,
    'required' => false,
    'width' => 'w-full',
    'name' => '',
    'label' => '',
    'id' => null,
    'rows' => 3,
    'helper' => '',
    'maxlength' => 250,
    'text' => '',
])
@if ($label)
    <x-lavx::form.label for="{{ $name }}" value="{{ $label }}" />
@endif
<textarea
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    rows="{{ $rows }}"
    maxlength="{{ $maxlength }}"
    {{ $attributes->merge(['class' => $width . ' rounded-lg shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400']) }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }}
>{{ $text }}</textarea>
@if ($helper)
    <x-lavx::form.helper :text="$helper" />
@endif