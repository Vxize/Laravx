@props([
    'value' => null,
    'label' => null,
    'name' => 'email',
])
<x-lavx::form.input
    :label=" $label ?? __('lavx::sys.email')"
    type="email"
    :name="$name"
    :value="$value ?? old('email') ?? '' "
    {{ $attributes }}
/>