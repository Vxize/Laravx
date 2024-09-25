@props([
    'disabled' => false,
    'checked' => false,
    'required' => false,
    'readonly' => false,
    'value' => '',
    'id',
    'name',
    'label',
    'textColor' => '',
])

<x-lavx::form.label class="inline-flex items-center ml-2">
    <x-lavx::form.input
        id="{{ $id ?? $name }}"
        type="radio"
        class="lg:w-8 md:w-6 sm:w-5 lg:h-8 md:h-6 sm:h-5 text-blue-600 disabled:opacity-50"
        name="{{ $name }}"
        value="{{ $value }}"
        rounded="rounded-full"
        :required=" $required "
        :disabled=" $disabled "
        :checked=" $checked "
        :readonly=" $readonly "
        {{ $attributes }}
    />
    <span class="ml-2 {{ $textColor }}">{{ $label }}</span>
</x-lavx::form.label>