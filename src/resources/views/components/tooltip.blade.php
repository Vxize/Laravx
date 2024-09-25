@props([
    'icon' => 'fa-solid:info-circle',
    'titleText' => '',
    'helperText',
])
<span class="relative inline-flex items-center space-x-2 w-full max-w-sm">
    {{ $titleText }}
    <span class="inline group ml-2">
        <span>
            <x-lavx::icon :icon="$icon" />
        </span>
        <span class="invisible group-hover:visible font-normal absolute top-0 left-0 z-10 space-y-1 bg-gray-800 text-gray-50 text-sm rounded-lg px-4 py-2 w-full max-w-md shadow-md" role="tooltip" aria-hidden="true">
            {{ $helperText ?? $slot }}
        </span>
    </span>
</span>