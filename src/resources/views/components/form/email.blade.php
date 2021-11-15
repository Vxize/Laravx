@props(['value' => null])
<x-lavx::form.input :label="__('lavx::sys.email')" type="email" name="email" :value="$value ?? old('email')" {{ $attributes }} />