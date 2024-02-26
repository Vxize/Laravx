@props([
    'disabled' => false,
    'checked' => false,
    'required' => false,
    'readonly' => false,
    'name' => '',
    'label' => '',
    'labelDisplay' => 'block',
    'helper' => '',
    'id' => null,
])
@if ($label)
    <x-lavx::form.label for="{{ $name }}" value="{{ $label }}" display="{{ $labelDisplay }}" />
@endif
<input 
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'rounded-lg shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 disabled:cursor-not-allowed']) }}
    @required($required)
    @disabled($disabled)
    @checked($checked)
    @readonly($readonly)
>
@if ($helper)
    <x-lavx::form.helper :text="$helper" />
@endif