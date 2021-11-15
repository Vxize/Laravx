@props([
    'disabled' => false,
    'checked' => false,
    'name' => '',
    'label' => '',
    'id' => null,
])
@if ($label)
    <x-lavx::form.label for="{{ $name }}" value="{{ $label }}" />
@endif
<input 
    {{ $disabled ? 'disabled' : '' }}
    {{ $checked ? 'checked' : '' }}
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'rounded-lg shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400']) }}
>
