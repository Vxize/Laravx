@props([
    'container_padding' => 'p-4',
    'container_width' => 'w-full max-w-full',
    'width' => 'max-w-md',
    'margin' => '',
    'padding' => 'p-6',
    'background' => 'bg-white',
])
<x-lavx::layout.app>
    <x-lavx::flex>
        <div class="{{ $container_padding }} {{ $container_width }}">
            <x-lavx::box
                margin="{{ $margin }}"
                width="{{ $width }}"
                padding="{{ $padding }}"
                background="{{ $background }}"
            >
                {{ $slot ?? '' }}
            </x-lavx::box>
        </div>
    </x-lavx::flex>
</x-lavx::layout.app>