@props([
    'disabled' => false,
    'checked' => false,
    'value' => '',
    'id',
    'name',
    'label',
])

<x-lavx::form.label class="inline-flex items-center ml-2">
    <x-lavx::form.input
        id="{{ $id ?? $name }}"
        type="radio"
        class="text-indigo-600"
        name="{{ $name }}"
        value="{{ $value }}"
        disabled="{{ $disabled }}"
        checked="{{ $checked }}"
        {{ $attributes }}
    />
    <span class="ml-2">{{ $label }}</span>
</x-lavx::form.label>