@props(['text'])

<p {{ $attributes->merge(['class' => 'my-2 lg:text-base md:text-sm text-xs']) }}>
    {{ $text ?? $slot }}
</p>
