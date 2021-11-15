@props([
    'link' => '',
    'external' => false,
    'text',
])
<a {{ $attributes->merge(['class' => 'no-underline text-blue-600 hover:opacity-50', 'href' => $link]) }}
    @if ($external)
        rel="noopener noreferrer" target="_blank"
    @endif
>
    {{ $text ?? $slot }}
</a>