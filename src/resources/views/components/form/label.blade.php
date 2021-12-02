@props(['value'])

<label {{ $attributes->merge(['class' => 'my-2 block font-medium lg:text-xl md:text-lg text-base']) }}>
    {{ $value ?? $slot }}
</label>
