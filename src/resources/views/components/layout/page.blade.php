@props([
    'width' => 'max-w-md',
    'margin' => 'mx-auto mt-6',
    'padding' => 'p-6',
    'background' => 'bg-white',
])
<x-lavx::layout.app>
    <x-lavx::flex>
        <x-lavx::box
            margin="{{ $margin }}"
            width="{{ $width }}"
            padding="{{ $padding }}"
            background="{{ $background }}"
        >
            {{ $slot ?? '' }}
        </x-lavx::box>
    </x-lavx::flex>
</x-lavx::layout.app>