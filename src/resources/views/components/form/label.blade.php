@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium lg:text-lg md:text-base text-sm']) }}>
    {{ $value ?? $slot }}
</label>
