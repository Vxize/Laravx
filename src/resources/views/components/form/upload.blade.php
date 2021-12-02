@props([
    'disabled' => false,
    'multiple' => true,
    'required' => false,
    'name' => '',
    'label' => '',
    'helper' => '',
    'id' => null,
])
@if ($label)
    <x-lavx::form.label for="{{ $name }}" value="{{ $label }}" />
@endif
<input 
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    type="file"
    {{ $attributes->merge(['class' => 'placeholder-gray-400']) }}
    {{ $multiple ? 'multiple' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }}
>
@if ($helper)
    <x-lavx::form.helper :text="$helper" />
@endif