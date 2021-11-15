@props([
    'link' => '',
    'icon' => '',
    'text' => '',
    'active' => false,
    'submit' => false,
])
@php
    $url = request()->url();
    if ($link === $url) {
        $active = true;
    } else {
        $path = request()->path();
        $active = $link === $path || $link === '/'.$path;
    }
@endphp

@if ($submit)
    <button type="submit"    
@else
    <a href="{{ $link }}"
@endif

    class="block p-2 focus:outline-none focus:shadow-outline w-full text-left
    dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200
    {{ $active
        ? 'text-gray-900 font-bold bg-gray-200 dark-mode:bg-gray-700'
        : 'hover:bg-gray-200 hover:text-gray-900 dark-mode:bg-transparent'
    }}
">
    <x-lavx::icon icon="{{ $icon }}" class="mx-2" />
    <span>{{ $text }}</span>

@if ($submit)
    </button>
@else
    </a>
@endif