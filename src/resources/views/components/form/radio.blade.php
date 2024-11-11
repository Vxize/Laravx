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
    'width' => 'lg:w-8 md:w-6 sm:w-5',
    'height' => 'lg:h-8 md:h-6 sm:h-5',
    'color' => 'text-blue-600',
    'disable' => 'disabled:opacity-50',
])

<x-lavx::form.label display="inline-flex items-center">
    <x-lavx::form.input
        id="{{ $id ?? $name }}"
        type="radio"
        class="{{ $width }} {{ $height }} {{ $color }} {{ $disable }} "
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