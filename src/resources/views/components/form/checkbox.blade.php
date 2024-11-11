@props([
    'disabled' => false,
    'checked' => false,
    'id',
    'name',
    'label',
    'for',
    'textColor' => '',
    'escaped' => false,
    'width' => 'lg:w-8 md:w-6 sm:w-5',
    'height' => 'lg:h-8 md:h-6 sm:h-5',
    'color' => 'text-blue-600',
    'disable' => 'disabled:opacity-50 disabled:cursor-not-allowed',
    'labelClass' => 'inline-flex items-center ml-2',
])

<x-lavx::form.label for="{{ $for ?? $id ?? $name }}" class="{{$labelClass}}">
    <x-lavx::form.input
        id="{{ $id ?? $name }}"
        type="checkbox"
        class="{{$width}} {{$height}} {{$color}} {{$disable}}"
        name="{{ $name }}"
        :disabled=" $disabled "
        :checked=" $checked "
        {{ $attributes }}
    />
    <span class="ml-2 {{ $textColor }}">
        @if (empty($escaped))
            {{ $label ?? $slot }}
        @else
            {!! $label ?? $slot !!}
        @endif
    </span>
</x-lavx::form.label>